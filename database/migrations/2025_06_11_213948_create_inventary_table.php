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
        Schema::create('inventary', function (Blueprint $table) {
            $table->id();
            $table->string('notes')->nullable();
            $table->string('name')->comment('Product name');
            $table->foreignId('product_id')->constrained('product')->onDelete('cascade');
            $table->decimal('price');
            $table->foreignId('supplier_id')->constrained('supplier')->onDelete('cascade');
            $table->decimal('quantity')->default(0)->comment('Available quantity in stock');
           $table->created_at();
           $table->updated_at();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventary');
    }
};
