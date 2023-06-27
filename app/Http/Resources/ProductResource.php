<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category' => $this->id_category,
            'product_name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'weight' => $this->weight,
            'price' => $this->price,
            'brand' => $this->brand
        ];
    }
}
