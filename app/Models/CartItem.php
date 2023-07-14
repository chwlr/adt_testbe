<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_item';

    public function cartItems(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
