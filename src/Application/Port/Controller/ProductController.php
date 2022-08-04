<?php

declare(strict_types=1);

namespace App\Application\Port\Controller;

use App\Domain\Message\Command\CreateProduct;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\Authorization;
use Symfony\Component\Mercure\Discovery;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class ProductController
{
    #[Route('/api/product/notification/factory/{factoryId}', name: 'factory_notification')]
    public function notification(
        Discovery $discovery,
        Authorization $authorization,
        Request $request,
        int $factoryId
    ): JsonResponse {
        $topic = 'http://localtest.me/notifications/product/factory/' . $factoryId;
        $discovery->addLink($request);
        $authorization->setCookie($request, [$topic]);

        return new JsonResponse(['topic' => $topic], Response::HTTP_OK);
    }

    #[Route('/api/product/factory/{factoryId}', name: 'create_product')]
    public function createProduct(
        MessageBusInterface $messageBus,
        Request $request,
        int $factoryId
    ): JsonResponse {
        $command = new CreateProduct($factoryId, $request->get('name'));
        try {
            $messageBus->dispatch($command);
        } catch (Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
