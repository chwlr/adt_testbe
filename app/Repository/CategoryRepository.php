<?php

namespace App\Repository;

interface CategoryRepository {
    public function getCategory($category);
    public function getAllCategory();
    public function storeCategory($attribute);
    public function updateCategory($attribute, $category);
    public function deleteCategory($category);
}
