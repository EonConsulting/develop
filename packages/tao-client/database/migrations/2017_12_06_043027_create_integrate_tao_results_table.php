<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegrateTaoResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrate_tao_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('storyline_item_id');
            $table->string('lis_result_sourcedid');
            $table->string('delivery_execution_id')->nullable();
            $table->string('test_taker')->nullable();
            $table->string('score')->nullable();
            $table->longText('response')->nullable();
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
        Schema::dropIfExists('integrate_tao_results');
    }
}
