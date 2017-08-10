<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateGraphsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lti_graphs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('code');
            $table->string('name');
         $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
         $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lti_graphs');
    }
}
