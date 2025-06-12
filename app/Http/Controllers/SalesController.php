<?php

namespace App\Http\Controllers;
use App\Models\SalesModel;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index() {
        $sales = SalesModel::all();
        return response()->json($sales);
    }

    public function show($id) {
        $sale = SalesModel::find($id);
        if (!$sale) {
            return response()->json(['message' => 'Sale not found'], 404);
        }
        return response()->json($sale);
    }
    public function store(Request $request) {
        $data = $request->validate([
            'customer_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'sale_date' => 'required|date',
            'notes' => 'nullable|string|max:500',
        ]);

        $sale = SalesModel::create($data);
        return response()->json($sale, 201);
    }
    public function update(Request $request, $id) {
        $sale = SalesModel::find($id);
        if (!$sale) {
            return response()->json(['message' => 'Sale not found'], 404);
        }

        $data = $request->validate([
            'customer_id' => 'sometimes|integer',
            'product_id' => 'sometimes|integer',
            'quantity' => 'sometimes|numeric',
            'sale_price' => 'sometimes|numeric',
            'sale_date' => 'sometimes|date',
            'notes' => 'nullable|string|max:500',
        ]);

        $sale->update($data);
        return response()->json($sale);
    }
    public function destroy($id) {
        $sale = SalesModel::find($id);
        if (!$sale) {
            return response()->json(['message' => 'Sale not found'], 404);
        }

        $sale->delete();
        return response()->json(['message' => 'Sale deleted successfully']);
    }
    public function search(Request $request) {
        $searchTerm = $request->query('q');
        if (!$searchTerm) {
            return response()->json(['message' => 'Search term is required'], 400);
        }

        $sales = SalesModel::search($searchTerm)->get();
        return response()->json($sales);
    }
    public function filter(Request $request) {
        $query = SalesModel::query();

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->has('date_from') && $request->has('date_to')) {
            $query->whereBetween('sale_date', [
                $request->input('date_from'),
                $request->input('date_to')
            ]);
        }

        if ($request->has('customer_id')) {
            $query->where('customer_id', $request->input('customer_id'));
        }

        $sales = $query->get();
        return response()->json($sales);
    }
    public function statistics() {
        $totalSales = SalesModel::count();
        $totalRevenue = SalesModel::sum('total');
        $averageSaleValue = SalesModel::avg('total');

        return response()->json([
            'total_sales' => $totalSales,
            'total_revenue' => $totalRevenue,
            'average_sale_value' => $averageSaleValue,
        ]);
    }
    public function recentSales() {
        $sales = SalesModel::orderBy('sale_date', 'desc')->take(10)->get();
        return response()->json($sales);
    }
    public function salesByProduct($productId) {
        $sales = SalesModel::where('product_id', $productId)->get();
        if ($sales->isEmpty()) {
            return response()->json(['message' => 'No sales found for this product'], 404);
        }
        return response()->json($sales);
    }
     public function SalesReport(Request $request) {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        if (!$dateFrom || !$dateTo) {
            return response()->json(['message' => 'Date range is required'], 400);
        }

        $sales = SalesModel::whereBetween('sale_date', [$dateFrom, $dateTo])->get();
        return response()->json($sales);
}
}
