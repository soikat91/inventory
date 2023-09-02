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
        Schema::create('invoice_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->string('qty',50);
            $table->string('sale_price',50);
            $table->foreign('invoice_id')->references('id')->on('invoices')
            ->cascadeOnDelete()->restrictOnUpdate();
            $table->foreign('product_id')->references('id')->on('products')
            ->cascadeOnDelete()->restrictOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')
            ->cascadeOnDelete()->restrictOnUpdate();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_products');
    }
};
