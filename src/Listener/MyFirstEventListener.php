<?php declare(strict_types = 1);
namespace Eventsourcing\Listener;

use Eventsourcing\Event\Event;

class MyFirstEventListener implements EventListener {
    public function notify(Event $event): void {
        print 'GOT EVENT ' . \get_class($event) . "\n";
    }
}
