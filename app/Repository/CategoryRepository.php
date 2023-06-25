<?php

namespace App\Repository;

interface CategoryRepository {
    public function getAllCategory();
    public function storeCategory($attribute);
    public function updateCategory($attribute);
    public function deleteCategory($category);
}
