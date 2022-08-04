<?php
declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Domain\Message\Command\CreateProduct;
use App\Domain\Product;
use App\Domain\Product\ProductId;
use App\Domain\Product\Status;
use App\Domain\ProductRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class CreateProductHandler
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    public function __invoke(CreateProduct $command): void
    {
        $product = new Product(new ProductId(Uuid::uuid4()), Status::CREATED, $command->name());

        $this->productRepository->save($product);
    }
}
