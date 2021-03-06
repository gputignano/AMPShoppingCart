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
            $table->nullableMorphs('entity');
            $table->boolean('is_active')->default(false);
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
