<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        return $this->cartService->indexCartService();
    }

    public function store(Request $request)
    {
        return $this->cartService->storeCartService($request);
    }

    public function show(string $cart)
    {
        return $this->cartService->showCartService($cart);
    }

    public function update(Request $request, string $cart)
    {
        return $this->cartService->updateCartService($request, $cart);
    }

    public function destroy(string $cart)
    {
        return $this->cartService->destroyCartService($cart);
    }
}
