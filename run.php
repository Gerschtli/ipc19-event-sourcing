<?php declare(strict_types = 1);
namespace Eventsourcing;

use Eventsourcing\Infrastructure\FileSystemEventReader;
use Eventsourcing\Infrastructure\FileSystemEventWriter;
use Eventsourcing\Listener\CheckoutCartDisplayUpdater;
use Eventsourcing\Listener\EventDispatcher;
use Eventsourcing\Model\BillingAddress;
use Eventsourcing\Model\SessionId;
use Eventsourcing\Projector\CartCheckoutDisplay;
use Eventsourcing\Service\CartService;
use Eventsourcing\Service\CheckoutService;

require __DIR__ . '/src/autoload.php';

$sessionId = new SessionId('has4t1glskcktjh4ujs9eet26u');

$dispatcher = new EventDispatcher();
$dispatcher->registerListener(
    new CheckoutCartDisplayUpdater(new CartCheckoutDisplay())
);


$checkoutService = new CheckoutService(
    $sessionId,
    new CartService,
    new FileSystemEventWriter,
    new FileSystemEventReader,
    $dispatcher
);


$checkoutService->start();

// ...

$checkoutService->defineBillingAddress(new BillingAddress());

