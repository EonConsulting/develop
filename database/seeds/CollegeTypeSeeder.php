<?php

use Illuminate\Database\Seeder;

class CollegeTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $table = "lk_college_type";

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($table)->truncate();

        DB::table($table)->insert(
                [
                    'description' => 'Accounting Sciences',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Agriculture and Environmental Sciences',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Economic and Management Sciences',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Education',
                    'sequence' => 4
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Human Sciences',
                    'sequence' => 6
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Law',
                    'sequence' => 7
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Science, Engineering and Technology',
                    'sequence' => 8
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Graduate Studies',
                    'sequence' => 5
                ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
