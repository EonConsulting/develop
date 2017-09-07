<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStorylineItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('storyline_items', function($table) {

            //$table->unsignedInteger("content_id")->nullable()->default(null);
            
            $table->foreign('content_id', 'content_ibfk_2')
                ->references('id')->on('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('storyline_items', function($table) {
            $table->dropColumn('content_id');
        });
    }
}
