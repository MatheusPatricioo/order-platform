<?php

declare(strict_types=1);

namespace App\Features\Product\Domain\Exceptions;

use App\Shared\Domain\Exceptions\DomainException;

final class InvalidProductName extends DomainException
{
    public function __construct(int $maxLength)
    {
        parent::__construct("Product name must have between 1 and {$maxLength} characters.");
    }
}
