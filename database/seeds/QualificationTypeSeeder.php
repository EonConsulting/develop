<?php

use Illuminate\Database\Seeder;

class QualificationTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $table = "lk_qualification_type";

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($table)->truncate();

        DB::table($table)->insert(
                [
                    'description' => 'Certificate',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Diploma',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Degree',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Honours Degree',
                    'sequence' => 5
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Masters Degree',
                    'sequence' => 6
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Doctoral Degree',
                    'sequence' => 4
                ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
