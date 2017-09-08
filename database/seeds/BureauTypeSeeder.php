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
        DB::table('lk_bureau_type')->insert(
            [
                'description' => 'Bureau of Market Research',
                'sequence' => 1
            ],
            [
                'description' => 'SA Business Review',
                'sequence' => 2
            ]
        );
    }
}
