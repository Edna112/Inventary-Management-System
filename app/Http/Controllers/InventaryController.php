<?php

namespace App\Http\Controllers;
use App\Models\InventaryModel;

use Illuminate\Http\Request;

class InventaryController extends Controller
{
    public function Index() {
        $inventary = InventaryModel::all();
         return response()->json($inventary);

    }
    public function show($id) {
        $inventary = InventaryModel::find($id);
        if(!$inventary) {
            return response()->json(['Message =>Not Found'],404);
        }
        return response()->json($inventary);


    }
     public function store(Request $request) {
        $data = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|numeric',
            'name' => 'required|string|max:255',
            'created_at' => 'required|date',
            'updated_at' => 'required|date',
            'price' => 'required|numeric',
            'notes' => 'nullable|string|max:500',
        ]);

        $inventary = InventaryModel::create($data);
        return response()->json($inventary, 201);

     }
    public function update(Request $request, $id) {
        $inventary = InventaryModel::find($id);
        if (!$inventary) {
            return response()->json(['message' => 'Inventary not found'], 404);
        }

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'product_id' => 'sometimes|integer',
            "price" => 'required|numeric',
            'quantity' => 'sometimes|numeric',
            'created_at' => 'sometimes|string|max:255',
            'updated_at' => 'sometimes|date',
            'notes' => 'nullable|string|max:500',
        ]);

        $inventary->update($data);
        return response()->json($inventary);
    }
    public function destroy($id) {
        $inventary = InventaryModel::find($id);
        if (!$inventary) {
            return response()->json(['message' => 'Inventary not found'], 404);
        }

        $inventary->delete();
        return response()->json(['message' => 'Inventary deleted successfully']);
    }
    public function search(Request $request) {
        $query = $request->input('query');
        $inventary = InventaryModel::where('name', 'LIKE', "%{$query}%")
            ->orWhere('notes', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($inventary);
    }
    public function filterBySupplier(Request $request, $supplierId) {
        $inventary = InventaryModel::where('supplier_id', $supplierId)->get();
        if ($inventary->isEmpty()) {
            return response()->json(['message' => 'No inventary found for this supplier'], 404);
        }
        return response()->json($inventary);
    }
    public function filterByProduct(Request $request, $productId) {
        $inventary = InventaryModel::where('product_id', $productId)->get();
        if ($inventary->isEmpty()) {
            return response()->json(['message' => 'No inventary found for this product'], 404);
        }
        return response()->json($inventary);
    }
    public function filterByPriceRange(Request $request) {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        if ($minPrice === null || $maxPrice === null) {
            return response()->json(['message' => 'Both min_price and max_price are required'], 400);
        }

        $inventary = InventaryModel::whereBetween('price', [$minPrice, $maxPrice])->get();
        return response()->json($inventary);
    }
    public function filterByDateRange(Request $request) {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate === null || $endDate === null) {
            return response()->json(['message' => 'Both start_date and end_date are required'], 400);
        }

        $inventary = InventaryModel::whereBetween('created_at', [$startDate, $endDate])->get();
        return response()->json($inventary);
    }

}
