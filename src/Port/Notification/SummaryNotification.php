<?php

declare(strict_types=1);

namespace App\Port\Notification;

use App\Domain\Status;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

final class SummaryNotification implements JsonSerializable
{
    public function __construct(private readonly Status $status)
    {
    }

    #[ArrayShape(['slaStatus' => Status::class])]
    public function jsonSerialize(): array
    {
        return ['slaStatus' => $this->status];
    }
}
