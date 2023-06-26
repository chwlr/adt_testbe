<?php

namespace App\Repository\Implementation;

use App\Exceptions\GeneralJsonException;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use App\Repository\CategoryRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CategoryRepositoryImpl implements CategoryRepository
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategory($category): CategoryResource
    {
        try {
            return new CategoryResource($this->category->find($category));
        } catch (Exception $e) {
            throw new GeneralJsonException('Failed to retrieve data', 400);
        };
    }

    public function getAllCategory(): CategoryCollection
    {
        try {
            return new CategoryCollection($this->category->get());
        } catch (Exception $e) {
            throw new GeneralJsonException('Failed to retrieve data', 400);
        };
    }

    public function storeCategory($attribute): JsonResponse
    {
        $exist = $this->category->where([['name', '=', data_get($attribute, 'name')], ['size', '=', data_get($attribute, 'size')]])->get();

        if (!($exist->isEmpty()))
        {
            throw new GeneralJsonException('Failed to store, data with name and size already exist', 400);
        }

        try {
            DB::beginTransaction();
            $stored = $this->category->query()->create([
                'name' => data_get($attribute, 'name'),
                'size' => data_get($attribute, 'size')
            ]);
            DB::commit();
            return (new CategoryResource($stored->fresh()))->response()->setStatusCode(201);
        } catch (Exception $e) {
            DB::rollBack();
            throw new GeneralJsonException('Failed to store data', 400);
        }
    }

    public function updateCategory($attribute): CategoryResource
    {
        try {
            DB::beginTransaction();
            $categoryUpdated = $this->category->update([
                'name' => data_get($attribute, 'name'),
                'size' => data_get($attribute, 'size'),
            ]);
            DB::commit();
            return new CategoryResource($categoryUpdated);
        } catch (Exception $e) {
            DB::rollBack();
            throw new GeneralJsonException('Failed to update data', 400);
        }
    }

    public function deleteCategory($category): JsonResponse
    {
        $exist = Product::where('id_category', $category)->get();
        if (!($exist->isEmpty()))
        {
            throw new GeneralJsonException('Failed to store, data with name and size already exist', 400);
        }

        try {
            DB::beginTransaction();
            $user = $this->category->findOrFail($category);
            $user->delete();
            DB::commit();
            return response()->json("Data deleted");
        } catch (Exception $e){
            DB::rollBack();
            throw new GeneralJsonException('Failed to delete data', 400);
        }
    }
}
