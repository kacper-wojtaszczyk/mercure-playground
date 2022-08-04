<?php

declare(strict_types=1);

namespace App\Domain\Message;

use DateTimeInterface;

interface DomainEvent
{
    public function occurredAt(): DateTimeInterface;
    public function id(): EventId;
}
