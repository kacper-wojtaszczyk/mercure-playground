<?php

declare(strict_types=1);

namespace App\Domain;

enum Status: string
{
    case CREATED = 'created';
    case PRINTED = 'printed';
    case SHIPPED = 'shipped';
}
