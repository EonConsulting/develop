<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTemplates extends Migration
{
    public $set_schema_table = 'templates';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->text('custom_css')->nullable()->default(null)->after('styles');
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
            $table->dropColumn('custom_css');
        });
    }
}
