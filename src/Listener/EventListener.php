<?php declare(strict_types = 1);
namespace Eventsourcing\Listener;

use Eventsourcing\Event\Event;

interface EventListener {
    public function notify(Event $event): void;
}
