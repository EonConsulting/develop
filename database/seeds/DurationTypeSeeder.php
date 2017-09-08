<?php

use Illuminate\Database\Seeder;

class DurationTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $table = "lk_duration_type";

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($table)->truncate();

        DB::table($table)->insert(
                [
                    'description' => 'Course Duration',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Evaluation Duration',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Certification Duration',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Study Duration',
                    'sequence' => 5
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Online Interaction Duration',
                    'sequence' => 4
                ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
