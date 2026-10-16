<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

use App\Shared\Domain\Exceptions\InvalidQuantity;

final readonly class Quantity
{
    private function __construct(public int $value)
    {
        if ($value < 0) {
            throw new InvalidQuantity($value, minimum: 0);
        }
    }

    public static function of(int $value): self
    {
        return new self($value);
    }

    public static function positive(int $value): self
    {
        if ($value < 1) {
            throw new InvalidQuantity($value, minimum: 1);
        }

        return new self($value);
    }

    public function isGreaterThanOrEqualTo(self $other): bool
    {
        return $this->value >= $other->value;
    }
}
