<?php

namespace App\Repository\Implementation;

use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use App\Repository\CategoryRepository;

class CategoryRepositoryImpl implements CategoryRepository
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function getAllCategory(): CategoryCollection
    {
        try {
            return new CategoryCollection($this->category->get());
        } catch (Exception $e) {
            throw new GeneralJsonException('Failed to retrieve data', 400);
        };
    }

    public function storeCategory($attribute)
    {
        // TODO: Implement storeCategory() method.
    }

    public function updateCategory($attribute)
    {
        // TODO: Implement updateCategory() method.
    }

    public function deleteCategory($category)
    {
        // TODO: Implement deleteCategory() method.
    }
}
