<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderModel extends Model
{
    protected $table = 'purchase_orders';

    protected $fillable = [
        'supplier_id',
        'name',
        'product_id',
        'user_id',
        'supplier_id',
        'description',
        'order_number',
        'created_by',
        'total_amount',
        'barcode_symbol',
        'quantity',
        'order_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'order_date' => 'datetime',
    ];

    //public function supplier()
    //{
        //return $this->belongsTo(SupplierModel::class, 'supplier_id');
    //}

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
    public function scopeBySupplier($query, $supplierId)
    {
        return $query->where('supplier_id', $supplierId);
    }
    public function scopeByProduct($query, $productId)
    {
        return $query->where('product_id', $productId);
    }
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('order_date', [$startDate, $endDate]);
    }
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
