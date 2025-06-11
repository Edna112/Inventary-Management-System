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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('product_id')->constrained()->onDelete('cascade');
            // $table->integer('quantity');
            // $table->decimal('price', 10, 2);
            // $table->decimal('total', 10, 2);
            // $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->dateTime('sale_date');
            // $table->string('payment_method')->nullable();
            // $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            // $table->text('notes')->nullable();
            // $table->string('invoice_number')->unique()->nullable();
            // $table->string('transaction_id')->unique()->nullable();
            // $table->string('receipt_image')->nullable();
            // // $table->character('barcode')->unique()->nullable();
            // $table->string('shipping_address')->nullable();
            // $table->string('billing_address')->nullable();
            // $table->string('customer_email')->nullable();
            // $table->string('customer_phone')->nullable();
            // $table->string('customer_name')->nullable();
            // $table->string('customer_address')->nullable();
            // $table->string('shipping_method')->nullable();
            // $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
