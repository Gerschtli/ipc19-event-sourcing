<?php declare(strict_types = 1);
namespace Eventsourcing\Infrastructure;

use Eventsourcing\Model\EventLog;
use Eventsourcing\Model\SessionId;

interface EventReader {
    public function read(SessionId $id): EventLog;

    public function has(SessionId $sessionId): bool;
}
