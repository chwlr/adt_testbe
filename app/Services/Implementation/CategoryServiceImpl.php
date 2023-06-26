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

    public function getCategoryService($category)
    {
        return $this->categoryRepository->getCategory($category);
    }

    public function getAllCategoryService()
    {
        return $this->categoryRepository->getAllCategory();
    }

    public function storeCategoryService($attribute)
    {
        return $this->categoryRepository->storeCategory($attribute);
    }

    public function updateCategoryService($attribute)
    {
        return $this->categoryRepository->updateCategory($attribute);
    }

    public function deleteCategoryService($category)
    {
        return $this->categoryRepository->deleteCategory($category);
    }
}
