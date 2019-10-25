<?php declare(strict_types = 1);
namespace Eventsourcing\Infrastructure;

use Eventsourcing\Event\Event;
use Eventsourcing\Model\EventLog;
use Eventsourcing\Model\SessionId;

class FileSystemEventReader implements EventReader {
    public function read(SessionId $id): EventLog {
        $filename = '/tmp/' . $id->asString();

        $log = new EventLog();

        foreach (\file($filename) as $event) {
            $log->add(\unserialize($event, ['allowed_classes' => [Event::class]]));
        }

        return $log;
    }

    public function has(SessionId $sessionId): bool {
        return \file_exists('/tmp/' . $sessionId->asString());
    }
}
