<?php

declare(strict_types=1);

namespace App\Features\Product\Domain\ValueObjects;

use App\Features\Product\Domain\Exceptions\InvalidProductId;

final readonly class ProductId
{
    private const ULID_PATTERN = '/^[0-7][0-9A-HJKMNP-TV-Z]{25}$/';

    private function __construct(public string $value)
    {
    }

    public static function fromString(string $value): self
    {
        if (preg_match(self::ULID_PATTERN, $value) !== 1) {
            throw new InvalidProductId($value);
        }

        return new self($value);
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
