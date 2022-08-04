<?php

declare(strict_types=1);

namespace App\Infrastructure\Mongo\Type;

use App\Domain\Product\ProductId;
use Doctrine\ODM\MongoDB\Types\ClosureToPHP;
use Doctrine\ODM\MongoDB\Types\Type;
use Ramsey\Uuid\Uuid;

final class ProductIdType extends Type
{
    use ClosureToPHP;

    public function convertToPHPValue($value): ProductId
    {
        return new ProductId(Uuid::fromString($value));
    }

    public function convertToDatabaseValue($value): string
    {
        return (string) $value;
    }
}
