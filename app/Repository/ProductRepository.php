<?php

namespace App\Repository;

interface ProductRepository {
    public function getProduct($product);
    public function getAllProduct();
    public function storeProduct($attribute);
    public function updateProduct($attribute, $product);
    public function deleteProduct($product);
}
