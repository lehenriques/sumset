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
        Schema::create('product_shopping', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('shopping_id');
            $table->decimal('price', 12, 4);
            $table->decimal('discount', 12, 4);
            $table->string('quantity', 5);
            $table->primary(['product_id', 'shopping_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_shopping');
    }
};
