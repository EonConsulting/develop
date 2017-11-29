<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStudentProgressTable extends Migration {
    //public $set_schema_table = 'student_progress';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
       DB::statement('ALTER TABLE `student_progress` ADD `visited` VARCHAR(500) NULL AFTER `storyline_id`;'); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
       
    }

}
