<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

use App\Shared\Domain\Exceptions\InvalidMoneyException;

final readonly class Money
{
    private function __construct(public int $cents)
    {
        if ($cents < 0) {
            throw InvalidMoneyException::negativeAmount($cents);
        }
    }

    public static function fromCents(int $cents): self
    {
        return new self($cents);
    }

    public static function zero(): self
    {
        return new self(0);
    }

    public function add(self $other): self
    {
        return new self($this->cents + $other->cents);
    }

    public function multiply(int $quantity): self
    {
        if ($quantity < 0) {
            throw InvalidMoneyException::negativeQuantity($quantity);
        }

        return new self($this->cents * $quantity);
    }

    public function equals(self $other): bool
    {
        return $this->cents === $other->cents;
    }
}
