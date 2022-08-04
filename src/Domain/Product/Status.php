<?php

declare(strict_types=1);

namespace App\Domain\Product;

enum Status: string
{
    case CREATED = 'created';
    case PRINTED = 'printed';
    case SHIPPED = 'shipped';

    public function next(): ?Status
    {
        return match ($this) {
            self::CREATED => self::PRINTED,
            self::PRINTED => self::SHIPPED,
            self::SHIPPED => null,
        };
    }

}
