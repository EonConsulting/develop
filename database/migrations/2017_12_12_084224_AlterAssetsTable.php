<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAssetsTable extends Migration
{

    public $set_schema_table = 'assets';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->integer('ingested')->default(0);
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
            $table->dropColumn('ingested');
        });
    }
}
