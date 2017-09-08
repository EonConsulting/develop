<?php

use Illuminate\Database\Seeder;

class ApplicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = 'lk_application_type';

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($table)->truncate();

        DB::table($table)->insert(
            [
                'description' => 'Self-Study',
                'sequence' => 2
            ]
        );

        DB::table($table)->insert(
            [
                'description' => 'Course based',
                'sequence' => 1
            ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
