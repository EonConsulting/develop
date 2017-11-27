<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegrateTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement('CREATE TABLE IF NOT EXISTS `integrate_courses` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `title` varchar(255) NOT NULL,
            `description` longtext NOT NULL,
            `source_system` varchar(75) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT=\'stores all courses available from UNISA\'');
        
        DB::statement('CREATE TABLE IF NOT EXISTS `integrate_course_lecturers` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `course_id` int(11) NOT NULL,
            `lecturer_user_id` int(11) NOT NULL,
            `source_system` varchar(75) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT=\'stores all lecturer to courses associations from UNISA\'');
        
        DB::statement('CREATE TABLE IF NOT EXISTS `integrate_course_mentors` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `course_id` int(11) NOT NULL,
            `mentor_user_id` int(11) NOT NULL,
            `source_system` varchar(75) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT=\'stores all mentor to courses associations from UNISA\'');

        DB::statement('CREATE TABLE IF NOT EXISTS `integrate_mentor_users` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `course_id` int(11) NOT NULL,
            `mentor_user_id` int(11) NOT NULL,
            `student_user_id` int(11) NOT NULL,
            `source_system` varchar(75) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT=\'stores all mentor to student to course from UNISA\'');
        
        DB::statement('CREATE TABLE IF NOT EXISTS `integrate_assessment_types` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `type` varchar(75) NOT NULL,
            `description` varchar(255) NOT NULL,
            `source_system` varchar(75) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT=\'stores all mentor to student to course from UNISA\'');
        
        DB::statement('CREATE TABLE IF NOT EXISTS `integrate_results` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `course_id` int(11) NOT NULL,
            `assessment_type_id` varchar(75) NOT NULL,
            `student_user_id` int(11) NOT NULL,
            `description` varchar(255) NOT NULL,
            `student_result` decimal(5,2) NOT NULL,
            `class_result` decimal(5,2) NOT NULL,
            `source_system` varchar(75) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT=\'stores all results for student from UNISA and e-Content\'');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
