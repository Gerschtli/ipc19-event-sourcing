<?php declare(strict_types = 1);
namespace Eventsourcing\Projector;

use Eventsourcing\Model\CartItemCollection;

class CartCheckoutDisplay {
    public function project(CartItemCollection $cartItems): void {
        \file_put_contents(
            '/tmp/cart.html',
            \var_export($cartItems, true)
        );
    }
}
