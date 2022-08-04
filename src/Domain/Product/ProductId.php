<?php

declare(strict_types=1);

namespace App\Domain\Product;

use Ramsey\Uuid\UuidInterface;
use Stringable;

final class ProductId implements Stringable
{
    public function __construct(private readonly UuidInterface $value)
    {
    }

    public function __toString(): string
    {
        return $this->value->toString();
    }
}
