<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaoAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tao_assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('storyline_item_id')->nullable();
            $table->string('subject')->nullable();
            $table->string('predicate')->nullable();
            $table->string('object')->nullable();
            $table->timestamp('epoch')->nullable();
            $table->string('launch_url');
            $table->string('key');
            $table->string('secret');
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
        Schema::dropIfExists('tao_assessments');
    }
}
