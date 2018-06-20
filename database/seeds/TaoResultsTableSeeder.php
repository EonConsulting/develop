<?php

use Illuminate\Database\Seeder;
use EONConsulting\Exports\Models\TaoResult;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Storyline2\Models\StorylineItem;
use Illuminate\Database\Query\Builder;
use EONConsulting\LaravelLTI\Models\UserLTILink;

class TaoResultsTableSeeder extends Seeder
{

    public function __construct()
    {
        Builder::macro('orderByRandom', function () {

            $randomFunctions = [
                'mysql'  => 'RAND()',
                'pgsql'  => 'RANDOM()',
                'sqlite' => 'RANDOM()',
                'sqlsrv' => 'NEWID()',
            ];

            $driver = $this->getConnection()->getDriverName();

            return $this->orderByRaw($randomFunctions[$driver]);
        });
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $course_id = '59';


        for($i = 1;$i < 50; $i++)
        {
            $course = Course::find($course_id);
            $storyline = $course->latest_storyline();
            $student = UserLTILink::where('roles', 'Learner')->orderByRandom()->first();

            $item = StorylineItem::where('storyline_id', $storyline->id)->orderByRandom()->first();

            $result = factory(TaoResult::class, 1)->create([
                'user_id' => $student->user_id,
                'storyline_item_id' => $item->id,
                'response' => '',
            ]);
        }

    }
}
