<?php

use Illuminate\Database\Seeder;

class BureauTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = 'lk_bureau_type';

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($table)->truncate();

        DB::table($table)->insert(
            [
                'description' => 'Bureau of Market Research',
                'sequence' => 1
            ]
        );

        DB::table($table)->insert(
            [
                'description' => 'SA Business Review',
                'sequence' => 2
            ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
