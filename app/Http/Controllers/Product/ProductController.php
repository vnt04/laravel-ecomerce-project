<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Services\IProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    protected IProductService $productService;

    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request) {
        $products = $this->productService->getAllProducts();
        return response()->json([
            'message' => 'Get all products successfully',
            'total' => count($products),
            'products' => $products,
        ], 200);
    }
    
    public function create(StoreProductRequest $request) {
        $validatedData = $request->validated();

        $newProduct = $this->productService->createProduct($validatedData);

        return response()->json([
            'message' => 'Product created successfully',
            'product' => $newProduct
        ], 201);
    }

    public function getById($id) {
        $product = $this->productService->getProductById($id);
        if(!$product) {
            return response()->json([
                'message' => "Product with ID {$id} not found.",
            ],404);
        }
        return response()->json([
            'data' => $product,
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $data = $request->only(['name', 'description', 'price', 'stock']);

        $updatedProduct = $this->productService->updateProduct($id, $data);

        return response()->json([
            'message' => "Updated product ID {$id} successfully.",
            // 'product' => $updatedProduct,
        ], 200);
    }
    
    public function delete($id) {
        $this->productService->deleteProduct($id);
        return response()->json(['message' => "Deleted product ID {$id}"], 200);
    }

}
