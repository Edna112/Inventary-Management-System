<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;;

class ProductController extends Controller
{
    public function index(Request $request) {
        // Fetch all products
        $products = ProductModel::all();

        return response()->json($products);
    }
    public function show($id) {
        // Fetch a single product by ID
        $product = ProductModel::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }
    public function store(Request $request) {
        // Validate and create a new product
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'product_code' => 'required|string|max:255',
            'product_category_id' => 'required|integer',
            'main_product_id' => 'nullable|integer',
            'brand_id' => 'nullable|integer',
            'product_cost' => 'required|numeric',
            'product_price' => 'required|numeric',
            'product_unit' => 'required|string|max:50',
            'sale_unit' => 'nullable|string|max:50',
            'purchase_unit' => 'nullable|string|max:50',
            'stock_alert' => 'nullable|integer',
            'quantity_limit' => 'nullable|integer',
            'order_tax' => 'nullable|numeric',
            'tax_type' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:500',
            'barcode_symbol' => 'nullable|string|max:255',
        ]);

        $product = ProductModel::create($data);

        return response()->json($product, 201);
    }
    public function update(Request $request, $id) {
        // Validate and update an existing product
        $product = ProductModel::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'code' => 'sometimes|required|string|max:255',
            'product_code' => 'sometimes|required|string|max:255',
            'product_category_id' => 'sometimes|required|integer',
            'main_product_id' => 'nullable|integer',
            'brand_id' => 'nullable|integer',
            'product_cost' => 'sometimes|required|numeric',
            'product_price' => 'sometimes|required|numeric',
            'product_unit' => 'sometimes|required|string|max:50',
            'sale_unit' => 'nullable|string|max:50',
            'purchase_unit' => 'nullable|string|max:50',
            'stock_alert' => 'nullable|integer',
            'quantity_limit' => 'nullable|integer',
            'order_tax' => 'nullable|numeric',
            'tax_type' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:500',
            'barcode_symbol' => 'nullable|string|max:255',
        ]);

        $product->update($data);

        return response()->json($product);
    }
    public function destroy($id) {
        // Delete a product
        $product = ProductModel::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
    public function search(Request $request) {
        // Search products by name or code
        $query = $request->input('query');

        if (!$query) {
            return response()->json(['message' => 'Query parameter is required'], 400);
        }

        $products = ProductModel::where('name', 'like', '%' . $query . '%')
            ->orWhere('code', 'like', '%' . $query . '%')
            ->get();

        return response()->json($products);
    }
    public function filterByCategory(Request $request, $categoryId) {
        // Filter products by category
        $products = ProductModel::where('product_category_id', $categoryId)->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found for this category'], 404);
        }

        return response()->json($products);
    }
}
