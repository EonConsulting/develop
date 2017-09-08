<?php

use Illuminate\Database\Seeder;

class SchoolTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $table = "lk_school_type";

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($table)->truncate();

        DB::table($table)->insert(
                [
                    'description' => 'School of Accountancy',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'School of Applied Accountancy',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'School of Agriculture and Life Sciences',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'School of Environmental Sciences',
                    'sequence' => 6
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'School of Educational Studies',
                    'sequence' => 5
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'School of Teacher Education',
                    'sequence' => 10
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'School of Arts',
                    'sequence' => 4
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'School of Humanities',
                    'sequence' => 7
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'School of Social Sciences',
                    'sequence' => 9
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'School of Interdisciplinary Research and Graduate Studies (SIRGS)',
                    'sequence' => 8
                ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
