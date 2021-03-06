<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributable', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('attributable_id');
            $table->unsignedBigInteger('attribute_id');
            $table->nullableMorphs('value');

            $table->foreign('attributable_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributable');
    }
}
