<?php

namespace App\Repositories\Classes;

use App\Models\ProductModel;;

class ProductRepository
{
        // Implement the methods defined in ProductRepositoryInterface
    public function getAllProducts()
    {
        $products = ProductModel::all();
        return response()->json($products, 200);
    }

    public function getProductById($id)
    {
        $product = ProductModel::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product, 200);
    }

    public function createProduct(array $data)
    {
        $product = ProductModel::create($data);
        return response()->json($product, 201);
    }

    public function updateProduct($id, array $data)
    {
        $product = ProductModel::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->update($data);
        return response()->json($product, 200);
    }

    public function deleteProduct($id)
    {
        $product = ProductModel::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    public function searchProducts($query)
    {
        $products = ProductModel::where('name', 'like', "%{$query}%")->get();
        return response()->json($products, 200);
    }
}