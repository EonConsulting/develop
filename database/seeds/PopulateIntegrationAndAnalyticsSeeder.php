<?php

use Illuminate\Database\Seeder;

class PopulateIntegrationAndAnalyticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = "summary_module_progression";
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($table)->truncate();

        DB::table($table)->insert(
                [
                    'progress_type_id' => '1', //storyline
                    'course_id' => '14',
                    'storyline_id' => '47',
                    'module_progress' => '25',
                    'class_progress' => '12',
                    'progress_date' => '2017-12-01'
                ]
        );
        
        DB::table($table)->insert(
                [
                    'progress_type_id' => '1', //storyline
                    'course_id' => '14',
                    'storyline_id' => '47',
                    'module_progress' => '35',
                    'class_progress' => '10',
                    'progress_date' => '2018-02-01'
                ]
        );
        
        DB::table($table)->insert(
                [
                    'progress_type_id' => '1', //storyline
                    'course_id' => '16',
                    'storyline_id' => '55',
                    'module_progress' => '45',
                    'class_progress' => '11',
                    'progress_date' => '2017-12-01'
                ]
        );
        
        DB::table($table)->insert(
                [
                    'progress_type_id' => '1', //storyline
                    'course_id' => '16',
                    'storyline_id' => '55',
                    'module_progress' => '50',
                    'class_progress' => '9',
                    'progress_date' => '2018-02-01'
                ]
        );
        
        $table = "integrate_course_users";
        DB::table($table)->truncate();

        DB::table($table)->insert(
                [
                    'course_id' => '14',
                    'user_id' => '2'
                ]
        );
        
        DB::table($table)->insert(
                [
                    'course_id' => '14',
                    'user_id' => '3'
                ]
        );
        
        DB::table($table)->insert(
                [
                    'course_id' => '16',
                    'user_id' => '2'
                ]
        );
        
        DB::table($table)->insert(
                [
                    'course_id' => '16',
                    'user_id' => '3'
                ]
        );
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
