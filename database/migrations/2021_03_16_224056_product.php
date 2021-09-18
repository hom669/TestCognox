<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');
            $table->string('product');
            $table->string('observations');
            $table->string('quantity');
            $table->string('date_shipment');
            $table->foreignId('id_size')->nullable()->index();
            $table->foreignId('id_product_brand')->nullable()->index();
            $table->timestamps();
        });

        Schema::table('products', function($table) {
            $table->foreign('id_size')->references('id_size')->on('sizes');
        });

        Schema::table('products', function($table) {
            $table->foreign('id_product_brand')->references('id_product_brand')->on('product_brand');
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
}
