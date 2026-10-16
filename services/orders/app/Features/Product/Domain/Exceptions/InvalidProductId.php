<?php

declare(strict_types=1);

namespace App\Features\Product\Domain\Exceptions;

use App\Shared\Domain\Exceptions\DomainException;

final class InvalidProductId extends DomainException
{
    public function __construct(string $value)
    {
        parent::__construct("Invalid product id \"{$value}\": expected a ULID.");
    }
}
