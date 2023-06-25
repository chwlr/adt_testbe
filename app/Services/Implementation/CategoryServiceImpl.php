<?php

namespace App\Services\Implementation;

use App\Repository\CategoryRepository;
use App\Services\CategoryService;

class CategoryServiceImpl implements CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategoryService()
    {
        return $this->categoryRepository->getAllCategory();
    }

    public function storeCategoryService($attribute)
    {
        // TODO: Implement storeCategoryService() method.
    }

    public function updateCategoryService($attribute)
    {
        // TODO: Implement updateCategoryService() method.
    }

    public function deleteCategoryService($category)
    {
        // TODO: Implement deleteCategoryService() method.
    }
}
