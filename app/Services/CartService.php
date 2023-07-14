<?php

namespace App\Services;

interface CartService {
    public function indexCartService();
    public function storeCartService($attribute);
    public function showCartService($cart);
    public function updateCartService($attribute, $cart);
    public function destroyCartService($cart);
}
