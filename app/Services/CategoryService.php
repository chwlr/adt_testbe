<?php

namespace App\Services;

interface CategoryService
{
    public function getCategoryService($category);
    public function getAllCategoryService();
    public function storeCategoryService($attribute);
    public function updateCategoryService($attribute, $category);
    public function deleteCategoryService($category);
}
