<?php

namespace App\Repository;

interface CartRepository {
    public function indexCart();
    public function storeCart($attribute);
    public function showCart($cart);
    public function updateCart($attribute, $cart);
    public function destroyCart($cart);
}
