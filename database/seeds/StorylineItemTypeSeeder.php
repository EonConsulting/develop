<?php

use Illuminate\Database\Seeder;

class StorylineItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("lk_storyline_item_type")->truncate();
        
        $templates = [
            [
                'name' => 'Core',
                'description' => 'Mandatory content. Everyone has to compelete it.',
                'class' => 'sli-core',
            ],
            [
                'name' => 'Support',
                'description' => 'Supportive content. Optional for those who may be struggling.',
                'class' => 'sli-support',
            ],
            [
                'name' => 'Interest',
                'description' => 'Optional content. Optional additional content that may be interesting.',
                'class' => 'sli-interest',
            ]
        ];

        DB::table('lk_storyline_item_type')->insert($templates);
    }
}
