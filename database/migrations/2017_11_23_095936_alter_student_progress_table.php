<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStudentProgressTable extends Migration
{
     public $set_schema_table = 'student_progress';


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->integer('storyline_item_id')->nullable()->default(null)->after('course_id');
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
            $table->dropColumn('storyline_item_id');
        });
    }
}
