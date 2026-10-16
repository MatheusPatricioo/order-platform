<?php

declare(strict_types=1);

namespace Tests\Unit\Shared;

use App\Shared\Domain\ValueObjects\Money;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class MoneyTest extends TestCase
{
    public function testCreatesFromCents(): void
    {
        $this->assertSame(1990, Money::fromCents(1990)->cents);
    }

    public function testCannotBeNegative(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Money::fromCents(-1);
    }

    public function testAddsTwoAmounts(): void
    {
        $total = Money::fromCents(1000)->add(Money::fromCents(990));

        $this->assertSame(1990, $total->cents);
    }

    public function testMultipliesByQuantity(): void
    {
        $this->assertSame(5970, Money::fromCents(1990)->multiply(3)->cents);
    }

    public function testOperationsDoNotChangeTheOriginal(): void
    {
        $price = Money::fromCents(1000);

        $price->add(Money::fromCents(500));

        $this->assertSame(1000, $price->cents);
    }

    public function testComparesByValue(): void
    {
        $this->assertTrue(Money::fromCents(1990)->equals(Money::fromCents(1990)));
        $this->assertFalse(Money::fromCents(1990)->equals(Money::fromCents(1000)));
    }
}
