<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStorylineItemsTable extends Migration
{
     public $set_schema_table = 'storyline_items';


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->integer('required')->nullable()->default(null);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->dropColumn('required');
        });
    }
}
