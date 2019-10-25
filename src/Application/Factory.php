<?php declare(strict_types = 1);
namespace Eventsourcing\Application;

use Eventsourcing\Infrastructure\FileSystemEventReader;
use Eventsourcing\Infrastructure\FileSystemEventWriter;
use Eventsourcing\Listener\CheckoutCartDisplayUpdater;
use Eventsourcing\Listener\EventDispatcher;
use Eventsourcing\Model\SessionId;
use Eventsourcing\Projector\CartCheckoutDisplay;
use Eventsourcing\Service\CartService;
use Eventsourcing\Service\CheckoutService;

class Factory {
    public function createCheckoutService(SessionId $sessionId): CheckoutService {
        $dispatcher = new EventDispatcher();
        $dispatcher->registerListener(
            new CheckoutCartDisplayUpdater(new CartCheckoutDisplay())
        );

        return new CheckoutService(
            $sessionId,
            new CartService,
            new FileSystemEventWriter,
            new FileSystemEventReader,
            $dispatcher
        );
    }
}
