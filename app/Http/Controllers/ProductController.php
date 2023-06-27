<?php

namespace App\Http\Controllers;


use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->productService->getAllProductService();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->productService->storeProductService($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->productService->getProductService($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $product)
    {
        return $this->productService->updateProductService($request, $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $product)
    {
        return $this->productService->deleteProductService($product);
    }
}
