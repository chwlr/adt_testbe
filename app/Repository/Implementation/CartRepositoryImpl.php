<?php

namespace App\Repository\Implementation;

use App\Exceptions\GeneralJsonException;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Repository\CartRepository;
use Illuminate\Support\Facades\DB;

class CartRepositoryImpl implements CartRepository
{
    private Cart $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function indexCart()
    {
        $idUser = auth()->user()->id;
        return $this->cart->where('id_user', '=', $idUser)->get();
    }

    public function storeCart($attribute)
    {
        $exist = $this->cart->where([['id_user', '=', data_get($attribute, 'id_user')], ['status', '=', data_get($attribute, 'status')]])->get();

        if (!($exist->isEmpty()))
        {
            throw new GeneralJsonException('Failed to store, data with id_category, name, and brand already exist', 400);
        }

        try {
            DB::beginTransaction();
            $stored = $this->cart->create([
                'id_user' => data_get($attribute, 'id_user'),
                'status' => data_get($attribute, 'status')
            ]);
            DB::commit();
            return (new CartResource($stored->fresh()))->response()->setStatusCode(201);
        } catch (Exception $e) {
            throw new GeneralJsonException('Failed to store data', 400);
        }
    }

    public function showCart($cart)
    {
        // TODO: Implement showCart() method.
    }

    public function updateCart($attribute, $cart)
    {
        // TODO: Implement updateCart() method.
    }

    public function destroyCart($cart)
    {
        // TODO: Implement destroyCart() method.
    }
}
