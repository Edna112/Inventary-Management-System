<?php

namespace App\Http\Controllers;
use App\Models\PurchaseOrderModel;

use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index() {
        $purchaseOrders = PurchaseOrderModel::all();
        return response()->json($purchaseOrders);

    }
    public function show($id) {
        $purchaseOrder = PurchaseOrderModel::find($id);
        if (!$purchaseOrder) {
            return response()->json(['message' => 'Purchase Order not found'], 404);
        }
        return response()->json($purchaseOrder);
    }
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'supplier_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'order_date' => 'required|date',
            'status' => 'required|string|in:pending,approved,rejected',
            'notes' => 'nullable|string|max:500',
        ]);

        $purchaseOrder = PurchaseOrderModel::create($data);
        return response()->json($purchaseOrder, 201);
    }
    public function update(Request $request, $id) {
        $purchaseOrder = PurchaseOrderModel::find($id);
        if (!$purchaseOrder) {
            return response()->json(['message' => 'Purchase Order not found'], 404);
        }

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'supplier_id' => 'sometimes|integer',
            'product_id' => 'sometimes|integer',
            'quantity' => 'sometimes|numeric',
            'purchase_price' => 'sometimes|numeric',
            'order_date' => 'sometimes|date',
            'status' => 'sometimes|string|in:pending,approved,rejected',
            'notes' => 'nullable|string|max:500',
        ]);

        $purchaseOrder->update($data);
        return response()->json($purchaseOrder);
    }
    public function destroy($id) {
        $purchaseOrder = PurchaseOrderModel::find($id);
        if (!$purchaseOrder) {
            return response()->json(['message' => 'Purchase Order not found'], 404);
        }

        $purchaseOrder->delete();
        return response()->json(['message' => 'Purchase Order deleted successfully']);
    }
    public function pendingOrders() {
        $pendingOrders = PurchaseOrderModel::pending()->get();
        return response()->json($pendingOrders);
    }
    public function approvedOrders() {
        $approvedOrders = PurchaseOrderModel::approved()->get();
        return response()->json($approvedOrders);
    }
    public function rejectedOrders() {
        $rejectedOrders = PurchaseOrderModel::rejected()->get();
        return response()->json($rejectedOrders);
    }
    public function filterBySupplier(Request $request, $supplierId) {
        $purchaseOrders = PurchaseOrderModel::bySupplier($supplierId)->get();
        if ($purchaseOrders->isEmpty()) {
            return response()->json(['message' => 'No purchase orders found for this supplier'], 404);
        }
        return response()->json($purchaseOrders);
    }
    public function filterByProduct(Request $request, $productId) {
        $purchaseOrders = PurchaseOrderModel::byProduct($productId)->get();
        if ($purchaseOrders->isEmpty()) {
            return response()->json(['message' => 'No purchase orders found for this product'], 404);
        }
        return response()->json($purchaseOrders);
    }

    public function purchaseOrderReport(Request $request) {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if (!$startDate || !$endDate) {
            return response()->json(['message' => 'Start date and end date are required'], 400);
        }

        $purchaseOrders = PurchaseOrderModel::whereBetween('order_date', [$startDate, $endDate])->get();
        return response()->json($purchaseOrders);
    }
    public function search(Request $request) {
        $searchTerm = $request->query('q');
        if (!$searchTerm) {
            return response()->json(['message' => 'Search term is required'], 400);
        }

        $purchaseOrders = PurchaseOrderModel::where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('notes', 'LIKE', "%{$searchTerm}%")
            ->get();

        return response()->json($purchaseOrders);
    }
    public function generateBarcode($id) {
        $purchaseOrder = PurchaseOrderModel::find($id);
        if (!$purchaseOrder) {
            return response()->json(['message' => 'Purchase Order not found'], 404);
        }

        // Generate barcode symbol using the helper method
        $barcodeSymbol = $this->generateBarcodeSymbol($purchaseOrder->order_number);
        $purchaseOrder->barcode_symbol = $barcodeSymbol;
        $purchaseOrder->save();

        return response()->json(['barcode_symbol' => $barcodeSymbol]);
    }

    /**
     * Generate a simple barcode symbol string for a given order number.
     * Replace this with actual barcode generation logic/library as needed.
     */
    protected function generateBarcodeSymbol($orderNumber)
    {
        // Example: return a base64-encoded string as a placeholder
        return base64_encode('PO-' . $orderNumber);
    }
}
