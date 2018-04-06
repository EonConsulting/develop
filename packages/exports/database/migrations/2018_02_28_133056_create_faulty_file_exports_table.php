<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaultyFileExportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faulty_file_exports', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('exportable');
            $table->string('filetype');
            $table->longText('message')->nullable();
            $table->longText('exception')->nullable();
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
        Schema::dropIfExists('faulty_file_exports');
    }
}
