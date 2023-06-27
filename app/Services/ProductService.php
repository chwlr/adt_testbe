<?php

namespace App\Services;

interface ProductService {
    public function getProductService($product);
    public function getAllProductService();
    public function storeProductService($attribute);
    public function updateProductService($attribute, $product);
    public function deleteProductService($product);
}
