<?php

namespace App\Services;

interface CategoryService
{
    public function getCategoryService($category);
    public function getAllCategoryService();
    public function storeCategoryService($attribute);
    public function updateCategoryService($attribute);
    public function deleteCategoryService($category);
}
