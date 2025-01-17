<?php declare(strict_types = 1);
namespace Eventsourcing\Domain;

use Eventsourcing\Event\BillingAddressDefinedEvent;
use Eventsourcing\Event\CheckoutStartedEvent;
use Eventsourcing\Event\Event;
use Eventsourcing\Model\BillingAddress;
use Eventsourcing\Model\CartItemCollection;
use RuntimeException;

final class Checkout extends EventSourced {

    /** @var null|CartItemCollection */
    private $cartItems;

    /** @var bool */
    private $isStarted = false;

    /** @var null|BillingAddress */
    private $billingAddress;

    public function start(CartItemCollection $cartItems): void {
        $this->ensureNotStarted();

        $event = new CheckoutStartedEvent($cartItems);
        $this->processEvent($event);
    }

    public function defineBillingAddress(BillingAddress $address): void {
        $this->ensureStarted();

        $event = new BillingAddressDefinedEvent($address);
        $this->processEvent($event);
    }

    protected function handleEvent(Event $event): void {
        if ($event instanceof CheckoutStartedEvent) {
            $this->handleStartedEvent($event);

            return;
        }

        if ($event instanceof BillingAddressDefinedEvent) {
            $this->handleBillingAddressDefinedEvent($event);
        }
    }

    private function handleStartedEvent(CheckoutStartedEvent $event): void {
        $this->cartItems = $event->getCartItems();
        $this->isStarted = true;
    }

    private function handleBillingAddressDefinedEvent(BillingAddressDefinedEvent $event): void {
        $this->billingAddress = $event->getAddress();
    }

    private function ensureNotStarted(): void {
        if ($this->cartItems !== null) {
            throw new RuntimeException('Already started');
        }
    }

    private function ensureStarted(): void {
        if ($this->cartItems === null) {
            throw new RuntimeException('Not started yet!');
        }
    }
}
