<?php declare(strict_types = 1);
namespace Eventsourcing\Event;

use Eventsourcing\Model\BillingAddress;

class BillingAddressDefinedEvent implements Event {

    /** @var BillingAddress */
    private $address;

    public function __construct(BillingAddress $address) {
        $this->address = $address;
    }

    public function getAddress(): BillingAddress {
        return $this->address;
    }
}
