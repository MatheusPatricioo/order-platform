<?php

declare(strict_types=1);

namespace App\Shared\Domain\Exceptions;

final class InvalidQuantity extends DomainException
{
    public function __construct(int $value, int $minimum)
    {
        parent::__construct("Quantity must be at least {$minimum}, got {$value}.");
    }
}
