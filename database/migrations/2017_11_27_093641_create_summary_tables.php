<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSummaryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE IF NOT EXISTS `summary_module_progression` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `progress_type_id` int(11) NOT NULL,
            `course_id` int(11) NOT NULL,
            `module_progress` int(11) NOT NULL,
            `class_progress` int(11) NOT NULL,
            `progress_date` datetime NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT=\'stores aggregated data for module progression\'');
        
        DB::statement('CREATE TABLE IF NOT EXISTS `summary_student_progression` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `progress_type_id` int(11) NOT NULL,
            `course_id` int(11) NOT NULL,
            `student_user_id` int(11) NOT NULL,
            `progress` int(11) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT=\'stores aggregated data for student progression\'');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
