<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStudentProgressTable extends Migration {
    public $set_schema_table = 'student_progress';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
         Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->dropColumn('root');
            $table->dropColumn('furthest');
            $table->dropColumn('course_id');
            $table->dropColumn('current');
            $table->longText('visited')->after('storyline_id');
        });
       }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table($this->set_schema_table, function(Blueprint $table) {
            $table->integer('root');
            $table->integer('furthest');
            $table->integer('course_id');
            $table->integer('current');
        });
       
    }

}
