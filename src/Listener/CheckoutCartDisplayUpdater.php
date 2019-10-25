<?php declare(strict_types = 1);
namespace Eventsourcing\Listener;

use Eventsourcing\Event\CheckoutStartedEvent;
use Eventsourcing\Event\Event;
use Eventsourcing\Projector\CartCheckoutDisplay;

class CheckoutCartDisplayUpdater implements EventListener {

    /** @var CartCheckoutDisplay */
    private $projector;

    public function __construct(CartCheckoutDisplay $projector) {
        $this->projector = $projector;
    }

    public function notify(Event $event): void {
        if (!$event instanceof CheckoutStartedEvent) {
            return;
        }

        $this->projector->project($event->getCartItems());
    }
}
