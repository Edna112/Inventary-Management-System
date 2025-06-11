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
        Schema::create('purchase_order', function (Blueprint $table) {
            $table->id();
            // $table->sting('name')->comment('Name of the purchase order');
            // $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->comment('Status of the purchase order');
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->foreignId('product_id')->constrained('product')->onDelete('cascade');
            // $table->decimal('quantity', 10, 2)->comment('Quantity of products in the purchase order');
            // $table->string('notes')->nullable()->comment('Additional notes for the purchase order');
            // $table->text('description')->nullable()->comment('Description of the purchase order');
            // $table->string('order_number')->unique()->comment('Unique order number');
            // $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            // $table->date('order_date');
            // $table->string('barcode_symbol')->nullable()->comment('Barcode symbol for the purchase order');
            // $table->string('created_by')->nullable()->comment('User who created the purchase order');
            // $table->decimal('total_amount', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order');
    }
};
