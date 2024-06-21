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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('stock_quantity', false, true);
            $table->string('photo')->nullable();
            $table->timestamps();

            $table->foreignId('brand_id')->nullable()->references('id')->on('brands')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('wide_id')->nullable()->references('id')->on('wides')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tall_id')->nullable()->references('id')->on('talls')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('diameter_id')->nullable()->references('id')->on('diameters')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
