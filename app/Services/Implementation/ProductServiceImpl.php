<?php

namespace App\Services\Implementation;

use App\Repository\ProductRepository;
use App\Services\ProductService;

class ProductServiceImpl implements ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function getProductService($product)
    {
        return $this->productRepository->getProduct($product);
    }

    public function getAllProductService()
    {
        return $this->productRepository->getAllProduct();
    }

    public function storeProductService($attribute)
    {
        return $this->productRepository->storeProduct($attribute);
    }

    public function updateProductService($attribute, $product)
    {
        return $this->productRepository->updateProduct($attribute, $product);
    }

    public function deleteProductService($product)
    {
        return $this->productRepository->deleteProduct($product);
    }
}
