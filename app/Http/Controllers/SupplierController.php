<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierModel;

class SupplierController extends Controller
{
    public function index() {
        // Logic to retrieve and return all suppliers
        $suppliers = SupplierModel::all();
        return response()->json($suppliers);
    }
    public function show($id) {
        // Logic to retrieve a specific supplier by ID
        $supplier = SupplierModel::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }
        return response()->json($supplier);
    }
    public function store(Request $request) {
        // Logic to create a new supplier
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:500',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        $supplier = SupplierModel::create($data);
        return response()->json($supplier, 201);
    }
    public function update(Request $request, $id) {
        // Logic to update an existing supplier
        $supplier = SupplierModel::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'contact_info' => 'sometimes|string|max:500',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        $supplier->update($data);
        return response()->json($supplier);
    }
    public function destroy($id) {
        // Logic to delete a supplier
        $supplier = SupplierModel::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        $supplier->delete();
        return response()->json(['message' => 'Supplier deleted successfully']);
    }
    public function getProducts($id) {
        // Logic to retrieve products associated with a specific supplier
        $supplier = SupplierModel::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        $products = $supplier->products; // Assuming the SupplierModel has a products relationship
        return response()->json($products);
    }
}
