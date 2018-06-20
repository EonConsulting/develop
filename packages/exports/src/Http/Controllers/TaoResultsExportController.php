<?php

namespace EONConsulting\Exports\Http\Controllers;


use App\Http\Controllers\Controller;
use EONConsulting\Storyline2\Models\Storyline;
use EONConsulting\Storyline2\Models\StorylineItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Excel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaoResultsExportController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->validate([
            'course_id' => 'required',
            'dt_from' => 'required',
            'dt_to' => 'required',
        ], [
            'dt_from.required' => 'Please select period start date.',
            'dt_to.required' => 'Please select period end date.'
        ]);

        try {

            $storyline = Storyline::where(['course_id' => $form_data['course_id']])->firstOrFail();

        } catch(ModelNotFoundException $e)
        {
            return redirect()->route('courses', [])->with('flash.error', 'Unable to export course.');
        }

        $from = $this->carboniseDate($form_data['dt_from']);
        $to = $this->carboniseDate($form_data['dt_to']);

        $storyline_items = StorylineItem::where(['storyline_id' => $storyline->id])->byTaoResults($from, $to)->get();

        $user_results = $storyline_items->pluck('tao_results')->flatten(0)->groupBy('user_id')->map(function ($results)
        {
            $result = $results->first();

            return [
                'user_id' => $result->user_id,
                'name' => $result->user->name,
                'score' => $results->avg('score')
            ];
        });

        if($user_results->count() < 1)
        {
            return redirect()->route('courses', [])->with('flash.error', 'No results found.');
        }

        return $this->buildCsvFile($user_results);
    }

    /*
     * Helper function to turn date string into a Carbon instance
     *
     * @param string $date
     * @return \Carbon\Carbon
     */
    protected function carboniseDate($date)
    {
        return Carbon::parse($date);
    }

    /*
     * Build the csv file and return a instance of Excel
     *
     * @param array $user_results
     * @return \Excel
     */
    protected function buildCsvFile($user_results)
    {
        return Excel::create('Tao-Results', function($excel) use ($user_results) {

            $excel->setTitle('Course Export')
                ->setCreator('E-Content')
                ->setCompany('Unisa')
                ->setDescription('Course Results Export');

            $excel->sheet('Student Results', function($sheet) use ($user_results) {

                $sheet->setColumnFormat([
                    'D' => '0.00',
                ]);

                $sheet->cell('A1', function($cell)
                {
                    $cell->setValue('Student ID');
                });

                $sheet->cell('B1', function($cell)
                {
                    $cell->setValue('Student Name');
                });

                $sheet->cell('C1', function($cell)
                {
                    $cell->setValue('Assessment Type');
                });

                $sheet->cell('D1', function($cell)
                {
                    $cell->setValue('Score');
                });

                $i = 2;

                foreach ($user_results as $result)
                {
                    $sheet->cell('A' . $i, $result['user_id']);
                    $sheet->cell('B' . $i, $result['name']);
                    $sheet->cell('C' . $i, 'N/A');
                    $sheet->cell('D' . $i, $result['score']);

                    $i++;
                }
            });

        })->download('csv');
    }

}