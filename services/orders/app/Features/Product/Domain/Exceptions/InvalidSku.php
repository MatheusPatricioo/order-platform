<?php

declare(strict_types=1);

namespace App\Features\Product\Domain\Exceptions;

use App\Shared\Domain\Exceptions\DomainException;

final class InvalidSku extends DomainException
{
    public function __construct(string $value)
    {
        parent::__construct("Invalid SKU \"{$value}\": use 3 to 32 letters, digits or hyphens.");
    }
}
