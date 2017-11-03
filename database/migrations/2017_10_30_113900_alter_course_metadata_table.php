<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCourseMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //DB::statement('ALTER TABLE `student_progress` ALTER `storyline_item_id` DROP DEFAULT;');
        DB::statement('ALTER TABLE `course_metadata` ADD `metadata_type_id` INT(11) NOT NULL AFTER `course_id`, '
                . 'CHANGE `value` `value` VARCHAR(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;');
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
