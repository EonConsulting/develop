<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStudentProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //DB::statement('ALTER TABLE `student_progress` ALTER `storyline_item_id` DROP DEFAULT;');
        DB::statement('ALTER TABLE `student_progress`
            CHANGE COLUMN `storyline_item_id` `current` INT(11) NOT NULL AFTER `storyline_id`,
            ADD COLUMN `root` INT(11) NOT NULL AFTER `current`,
            ADD COLUMN `furthest` INT(11) NOT NULL AFTER `root`;');
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
