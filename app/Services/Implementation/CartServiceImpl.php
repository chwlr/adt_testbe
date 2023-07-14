<?php

namespace App\Services\Implementation;

use App\Repository\CartRepository;
use App\Services\CartService;

class CartServiceImpl implements CartService
{
    private CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function indexCartService()
    {
        return $this->cartRepository->indexCart();
    }

    public function storeCartService($attribute)
    {
        return $this->cartRepository->storeCart($attribute);
    }

    public function showCartService($cart)
    {
        return $this->cartRepository->showCart($cart);
    }

    public function updateCartService($attribute, $cart)
    {
        return $this->cartRepository->updateCart($attribute, $cart);
    }

    public function destroyCartService($cart)
    {
        return $this->cartRepository->destroyCart($cart);
    }
}
