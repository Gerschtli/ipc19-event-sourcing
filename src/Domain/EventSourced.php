<?php declare(strict_types = 1);
namespace Eventsourcing\Domain;

use Eventsourcing\Event\Event;
use Eventsourcing\Model\EventLog;

abstract class EventSourced {
    /** @var EventLog */
    private $eventLog;

    public function __construct(EventLog $eventLog) {
        $this->replay($eventLog);
        $this->eventLog = new EventLog();
    }

    public function getChanges(): EventLog {
        return $this->eventLog;
    }

    protected function processEvent(Event $event): void {
        $this->eventLog->add($event);
        $this->handleEvent($event);
    }

    abstract protected function handleEvent(Event $event): void;

    private function replay(EventLog $eventLog): void {
        foreach ($eventLog as $event) {
            $this->handleEvent($event);
        }
    }
}
