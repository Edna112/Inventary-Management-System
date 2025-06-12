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
        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Name of the supplier');
            $table->string('contact_person')->nullable()->comment('Contact person at the supplier');
            $table->string('email')->nullable()->comment('Email address of the supplier');
            $table->string('phone')->nullable()->comment('Phone number of the supplier');
            $table->string('address')->nullable()->comment('Physical address of the supplier');
            $table->string('notes')->nullable()->comment('Additional notes about the supplier');
            $table->string('created_by')->nullable()->comment('User who created the supplier record');
            $table->string('updated_by')->nullaxampble()->comment('User who last updated the supplier record');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier');
    }
};
