<?php declare(strict_types = 1);
namespace Eventsourcing\Model;

use ArrayIterator;
use Eventsourcing\Event\Event;
use IteratorAggregate;

class EventLog implements IteratorAggregate {

    /** @var Event[] */
    private $events = [];

    public static function fromArray(array $events): EventLog {
        $log = new self();

        foreach ($events as $event) {
            $log->add($event);
        }

        return $log;
    }

    public function add(Event $event): void {
        $this->events[] = $event;
    }

    public function getIterator(): ArrayIterator {
        return new ArrayIterator($this->events);
    }
}
