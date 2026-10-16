<?php

declare(strict_types=1);

namespace App\Shared\Domain\Exceptions;

use InvalidArgumentException;

final class InvalidMoneyException extends InvalidArgumentException
{
    public static function negativeAmount(int $cents): self
    {
        return new self("Money cannot be negative, got {$cents} cents.");
    }

    public static function negativeQuantity(int $quantity): self
    {
        return new self("Quantity cannot be negative, got {$quantity}.");
    }
}
