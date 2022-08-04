<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Product\ProductId;

interface ProductRepository
{
    public function save(Product $product): void;
    public function get(ProductId $id): Product;
}
