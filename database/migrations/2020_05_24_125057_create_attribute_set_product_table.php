<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeSetProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_set_product', function (Blueprint $table) {
            $table->unsignedBigInteger('attribute_set_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('attribute_set_id')->references('id')->on('attribute_sets')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('entities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_set_product');
    }
}
