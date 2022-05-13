<?php

declare(strict_types=1);

namespace App\Port\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\Authorization;
use Symfony\Component\Mercure\Discovery;
use Symfony\Component\Routing\Annotation\Route;

final class ProductController
{
    public function __construct(
        private readonly Discovery $discovery,
        private readonly Authorization $authorization,
    ) {
    }

    #[Route('/api/product/notification/factory/{factoryId}', name: 'factory_notification')]
    public function notification(
        Request $request,
        int $factoryId
    ): JsonResponse {
        $topic = 'https://localtest.me/notifications/product/factory/' . $factoryId;
        $this->discovery->addLink($request);
        $this->authorization->setCookie($request, [$topic]);

        return new JsonResponse(['topic' => $topic], Response::HTTP_OK);
    }
}
