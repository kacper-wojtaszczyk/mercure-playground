<?php

declare(strict_types=1);

namespace App\Domain\Message;

use Ramsey\Uuid\UuidInterface;
use Stringable;

final class EventId implements Stringable
{

    public function __construct(private readonly UuidInterface $value)
    {
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
