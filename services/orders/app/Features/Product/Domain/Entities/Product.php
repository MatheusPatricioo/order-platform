<?php

declare(strict_types=1);

namespace App\Features\Product\Domain\Entities;

use App\Features\Product\Domain\ValueObjects\ProductId;
use App\Features\Product\Domain\ValueObjects\ProductName;
use App\Features\Product\Domain\ValueObjects\Sku;
use App\Shared\Domain\ValueObjects\Money;
use App\Shared\Domain\ValueObjects\Quantity;

final class Product
{
    public function __construct(
        public readonly ProductId $id,
        public readonly ProductName $name,
        public readonly Sku $sku,
        public readonly Money $price,
        public private(set) Quantity $stock,
    ) {
    }

    public function hasStockFor(Quantity $quantity): bool
    {
        return $this->stock->isGreaterThanOrEqualTo($quantity);
    }
}
