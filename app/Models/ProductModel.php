<?php

namespace App\Models;

use App\Http\Resources\ProductResource;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'name',
        'code',
        'product_code',
        'product_category_id',
        'main_product_id',
        'brand_id',
        'product_cost',
        'product_price',
        'product_unit',
        'sale_unit',
        'purchase_unit',
        'stock_alert',
        'quantity_limit',
        'order_tax',
        'tax_type',
        'notes',
        'barcode_symbol',
    ];
}
