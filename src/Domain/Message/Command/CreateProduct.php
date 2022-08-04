<?php

declare(strict_types=1);

namespace App\Domain\Message\Command;

final class CreateProduct
{
    public function __construct(private readonly int $factoryId, private readonly string $name)
    {
    }

    public function factoryId(): int
    {
        return $this->factoryId;
    }

    public function name(): string
    {
        return $this->name;
    }
}
