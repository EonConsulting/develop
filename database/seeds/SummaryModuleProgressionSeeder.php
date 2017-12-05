<?php

use Illuminate\Database\Seeder;

class SummaryModuleProgressionSeeder extends Seeder
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
                    'class_progress' => '35',
                    'progress_date' => '2017-12-05'
                ]
        );

    }
}
