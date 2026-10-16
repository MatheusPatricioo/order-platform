<?php

declare(strict_types=1);

namespace App\Features\Product\Domain\ValueObjects;

use App\Features\Product\Domain\Exceptions\InvalidProductName;

final readonly class ProductName
{
    private const MAX_LENGTH = 255;

    private function __construct(public string $value)
    {
    }

    public static function fromString(string $value): self
    {
        $value = trim($value);
        $length = mb_strlen($value);

        if ($length === 0 || $length > self::MAX_LENGTH) {
            throw new InvalidProductName(self::MAX_LENGTH);
        }

        return new self($value);
    }
}
