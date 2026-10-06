<?php

declare(strict_types=1);

namespace Tests\Unit\Order;

use App\Features\Order\Domain\Enums\OrderStatus;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class OrderStatusTest extends TestCase
{
    public function testPendingCanMoveToAwaitingPaymentOrCanceled(): void
    {
        $this->assertTrue(OrderStatus::Pending->canTransitionTo(OrderStatus::AwaitingPayment));
        $this->assertTrue(OrderStatus::Pending->canTransitionTo(OrderStatus::Canceled));
    }

    public function testPendingCannotSkipDirectlyToPaid(): void
    {
        $this->assertFalse(OrderStatus::Pending->canTransitionTo(OrderStatus::Paid));
    }

    public function testAwaitingPaymentCanBePaidFailedOrCanceled(): void
    {
        foreach ([OrderStatus::Paid, OrderStatus::Failed, OrderStatus::Canceled] as $next) {
            $this->assertTrue(OrderStatus::AwaitingPayment->canTransitionTo($next));
        }
    }

    #[DataProvider('finalStatuses')]
    public function testFinalStatusesCannotTransition(OrderStatus $status): void
    {
        $this->assertTrue($status->isFinal());

        foreach (OrderStatus::cases() as $next) {
            $this->assertFalse($status->canTransitionTo($next));
        }
    }

    /** @return array<string, array{OrderStatus}> */
    public static function finalStatuses(): array
    {
        return [
            'paid' => [OrderStatus::Paid],
            'failed' => [OrderStatus::Failed],
            'canceled' => [OrderStatus::Canceled],
        ];
    }
}
