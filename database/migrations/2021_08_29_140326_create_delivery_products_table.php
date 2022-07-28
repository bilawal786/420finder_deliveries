<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_products', function (Blueprint $table) {
            $table->id();
            $table->integer('delivery_id');
            $table->string('name');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->decimal('price', 18,2)->nullable();
            $table->string('image');
            $table->string('sku')->nullable();
            $table->integer('category_id');
            $table->string('subcategory_ids');
            $table->string('subcategory_names');
            $table->integer('strain_id');
            $table->integer('genetic_id');
            $table->integer('thc_percentage')->unsigned()->nullable();
            $table->integer('cbd_percentage')->unsigned()->nullable();
            $table->tinyInteger('is_featured');
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
        Schema::dropIfExists('delivery_products');
    }
}
