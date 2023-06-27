<?php

namespace App\Repository\Implementation;

use App\Exceptions\GeneralJsonException;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repository\ProductRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductRepositoryImpl implements ProductRepository
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct($product): ProductResource
    {
        try {
            return new ProductResource($this->product->findOrFail($product));
        } catch (Exception $e) {
            throw new GeneralJsonException('Failed to retrieve data', 400);
        }
    }
    public function getAllProduct(): ProductCollection

    {
        try {
            return new ProductCollection($this->product->get());
        } catch (Exception $e) {
            throw new GeneralJsonException('Failed to retrieve data', 400);
        }
    }

    public function storeProduct($attribute)
    {
        $exist = $this->product->where([['id_category', '=', data_get($attribute, 'id_category')], ['name', '=', data_get($attribute, 'name')], ['brand', '=', data_get($attribute, 'brand')]])->get();

        if (!($exist->isEmpty()))
        {
            throw new GeneralJsonException('Failed to store, data with id_category, name, and brand already exist', 400);
        }

        try {
            DB::beginTransaction();
            $stored = $this->product->create([
                'id_category' => data_get($attribute, 'id_category'),
                'name' => data_get($attribute, 'name'),
                'description' => data_get($attribute, 'description'),
                'quantity' => data_get($attribute, 'quantity'),
                'weight' => data_get($attribute, 'weight'),
                'price' => data_get($attribute, 'price'),
                'brand' => data_get($attribute, 'brand')
            ]);
            DB::commit();
            return (new ProductResource($stored->fresh()))->response()->setStatusCode(201);
        } catch (Exception $e) {
            throw new GeneralJsonException($e->getMessage(), 400);
        }
    }

    public function updateProduct($attribute, $product): ProductResource
    {
        $product = $this->product->find($product);
        if (empty($product)) {
            throw new GeneralJsonException('Failed to update, data not found', 404);
        }

        try {
            DB::beginTransaction();
            $product->update([
                'id_category' => data_get($attribute, 'id_category') == null ? $product->getOriginal('id_category') : data_get($attribute, 'id_category'),
                'name' => data_get($attribute, 'name') == null ? $product->getOriginal('name') : data_get($attribute, 'name'),
                'description' => data_get($attribute, 'description') == null ? $product->getOriginal('description') : data_get($attribute, 'description'),
                'quantity' => data_get($attribute, 'quantity') == null ? $product->getOriginal('quantity') : data_get($attribute, 'quantity'),
                'weight' => data_get($attribute, 'weight') == null ? $product->getOriginal('weight') : data_get($attribute, 'weight'),
                'price' => data_get($attribute, 'price') == null ? $product->getOriginal('price') : data_get($attribute, 'price'),
                'brand' => data_get($attribute, 'brand') == null ? $product->getOriginal('brand') : data_get($attribute, 'brand'),
            ]);
            DB::commit();
            return new ProductResource($product);
        } catch (Exception $e){
            DB::rollBack();
            throw new GeneralJsonException('Failed to update data', 400);
        }
    }

    public function deleteProduct($product): JsonResponse
    {
        $product = $this->product->find($product);
        if (empty($product)) {
            throw new GeneralJsonException('Failed to delete, data not found', 404);
        }

        try {
            DB::beginTransaction();
            $product->delete();
            DB::commit();
            return response()->json("Data deleted");
        } catch (Exception $e){
            DB::rollBack();
            throw new GeneralJsonException('Failed to delete data', 400);
        }
    }
}
