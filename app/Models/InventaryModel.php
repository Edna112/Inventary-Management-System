<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventaryModel extends Model
{
   protected $table = 'inventary';

   protected $fillable = [
    'name',
    'product_id',
    'price',
    'supplier_id',
    'created-at',
    'updated_at'


   ];
    protected $casts = [
         'created_at' => 'datetime',
         'updated_at' => 'datetime',
    ];
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }
    //public function supplier()
    //{
        //return $this->belongsTo(SupplierModel::class, 'supplier_id');
    //}
}
