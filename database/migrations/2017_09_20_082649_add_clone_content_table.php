<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCloneContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content', function ($table) {
            $table->unsignedInteger('cloned_id')->nullable()->default(null);

            $table->foreign('cloned_id')
                ->references('id')->on('content')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content', function ($table) {
            $table->dropColumn('cloned_id');
        });
    }
}
