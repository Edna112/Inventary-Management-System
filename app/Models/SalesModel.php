<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesModel extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'invoice_no',
        'sale_date',
        'status',
        'quantity',
        'price',
        'payment_method',
        'customer_id',
        'product_id',
        'image',
        'barcode',
        'transaction_id',
        'receipt_image',
        'shipping_method',
        'shipping_cost',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'user_id',
        'total',
        'product_discount',
        'order_tax',
        'billing_address',
        'tax_type',
        'notes',
        'shipping_address',
        'grand_total',
        'paid_amount',
        'change_amount',
        'payment_status',
        'created_by',
    ];

    //public function customer()
    //{
        //return $this->belongsTo(CustomerModel::class, 'customer_id');
    //}
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('invoice_no', 'like', "%{$searchTerm}%")
                     ->orWhereHas('customer', function ($q) use ($searchTerm) {
                         $q->where('name', 'like', "%{$searchTerm}%")
                           ->orWhere('email', 'like', "%{$searchTerm}%");
                     })
                     ->orWhereHas('product', function ($q) use ($searchTerm) {
                         $q->where('name', 'like', "%{$searchTerm}%")
                           ->orWhere('barcode_symbol', 'like', "%{$searchTerm}%");
                     });
    }
    public function scopeFilterByDate($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }
    public function scopeFilterByCustomer($query, $customerId)
    {
        return $query->where('customer_id', $customerId);
    }
    public function scopeFilterByProduct($query, $productId)
    {
        return $query->where('product_id', $productId);
    }


}
