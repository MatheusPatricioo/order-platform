<?php

declare(strict_types=1);

namespace App\Features\Product\Domain\ValueObjects;

use App\Features\Product\Domain\Exceptions\InvalidSku;

final readonly class Sku
{
    private const PATTERN = '/^[A-Z0-9][A-Z0-9-]{2,31}$/';

    private function __construct(public string $value) {}

    public static function fromString(string $value): self
    {
        $normalized = strtoupper(trim($value));

        if (preg_match(self::PATTERN, $normalized) !== 1) {
            throw new InvalidSku($value);
        }

        return new self($normalized);
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
