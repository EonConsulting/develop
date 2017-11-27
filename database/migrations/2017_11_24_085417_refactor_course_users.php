<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorCourseUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement('RENAME TABLE `course_users` TO `integrate_course_users`');
        DB::statement('ALTER TABLE `integrate_course_users` DROP COLUMN email, DROP COLUMN `opted_out`, DROP COLUMN `opted_out_date`');
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
