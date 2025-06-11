<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique()->nullable();
            $table->string('barcode')->unique();
            $table->float('quantity');
            $table->float('buying price')->comment('Buying Price');
            $table->float('selling price')->comment('Selling Price');
            $table->float('quantity_alert');
            $table->float('tax');
            $table->text('description')->nullable();
            $table->decimal('price',8, 3);
            $table->string('category');
            $table->string('stock_alert')->nullable();
            $table->double('order_tax')->nullable();
            $table->enum('tax_type', [1, 2])->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
