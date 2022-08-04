<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Product\ProductId;
use App\Domain\Product\Status;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

#[Document]
final class Product
{
    public function __construct(
        #[Id(strategy: 'NONE', type: 'productId')]
        private readonly ProductId $id,
        #[Field(type: 'enum')]
        private Status $status,
        #[Field(type: 'string')]
        private string $name,
    ) {
    }
}
