<?php

declare(strict_types=1);

namespace App\Infrastructure\Mongo;

use App\Domain\Product;
use App\Domain\Product\ProductId;
use App\Domain\ProductRepository as ProductRepositoryInterface;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\LockException;
use Doctrine\ODM\MongoDB\Mapping\MappingException;
use RuntimeException;

final class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(private readonly DocumentManager $documentManager)
    {
    }

    public function save(Product $product): void
    {
        $this->documentManager->persist($product);
    }

    /**
     * @throws RuntimeException
     */
    public function get(ProductId $id): Product
    {
        return $this->documentManager->getRepository(Product::class)->find($id)
            ?? throw new RuntimeException('Product not found');
    }
}
