<?php declare(strict_types = 1);
namespace Eventsourcing\Infrastructure;

use Eventsourcing\Model\EventLog;
use Eventsourcing\Model\SessionId;

interface EventWriter {
    public function write(SessionId $id, EventLog $listOfEvents): void;
}
