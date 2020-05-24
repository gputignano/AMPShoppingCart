<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewrites', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('slug');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->text('meta_robots')->nullable();
            $table->boolean('enabled')->default(false);
            $table->unsignedBigInteger('entity_id');

            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewrites');
    }
}
