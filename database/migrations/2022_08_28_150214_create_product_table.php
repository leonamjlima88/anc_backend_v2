<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100)->index();
            $table->tinyInteger('type')->index()->default(0)->comment('[0-product, 1-service]');
            $table->string('sku_code', 36)->index()->nullable();
            $table->string('ean_code', 36)->index()->nullable();
            $table->string('manufacturing_code', 36)->index()->nullable();
            $table->string('identification_code', 36)->index()->nullable();
            $table->decimal('cost_price', 18, 4)->nullable();
            $table->decimal('sale_price', 18, 4)->nullable();
            $table->decimal('current_quantity', 18, 4)->nullable();
            $table->decimal('minimum_quantity', 18, 4)->nullable();
            $table->decimal('maximum_quantity', 18, 4)->nullable();
            $table->decimal('gross_weight', 18, 4)->nullable()->comment('Peso bruto');
            $table->decimal('net_weight', 18, 4)->nullable()->comment('Peso líquido');
            $table->decimal('packing_weight', 18, 4)->nullable()->comment('Peso da emablagem');
            $table->tinyInteger('is_to_move_the_stock')->default(1)->comment('Movimentar estoque');
            $table->tinyInteger('is_product_for_scales')->default(0)->comment('Produto para pesar na balança');
            $table->text('internal_note')->nullable();
            $table->string('complement_note', 80)->nullable();
            $table->tinyInteger('is_discontinued')->nullable()->comment('Item descontinuado');
            $table->foreignUuid('unit_id')->constrained('unit');
            $table->foreignUuid('category_id')->nullable()->constrained('category');
            $table->foreignUuid('brand_id')->nullable()->constrained('brand');
            $table->foreignUuid('size_id')->nullable()->constrained('size');
            $table->foreignUuid('storage_location_id')->nullable()->constrained('storage_location');
            $table->tinyInteger('genre')->default(0)->nullable()->comment('[0-none, 1-masculine, 2-feminine, 3-unissex]');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
