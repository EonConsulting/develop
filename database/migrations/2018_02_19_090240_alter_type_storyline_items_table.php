<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTypeStorylineItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('storyline_items', function (Blueprint $table) {
            $table->unsignedInteger('type')->nullable()->default(null);

            $table->foreign('type', 'storyline_items_ibfk_2')
                ->references('id')->on('lk_storyline_item_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('storyline_items', function ($table) {
            $table->dropColumn('type');
        });
    }
}
