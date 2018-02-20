<?php

namespace EONConsulting\Exports\Http\Controllers;

use App\Http\Controllers\Controller;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Storyline2\Models\Storyline;
use EONConsulting\Storyline2\Models\StorylineItem;
use EONConsulting\Storyline2\Controllers\Storyline2ViewsJSON as Storyline2JSON;
use EONConsulting\Student\Progression\Http\Controllers\DefaultController as StudentProgress;
use App\Models\ContentTemplates;
use App\Models\LtiUser;
use EONConsulting\Storyline2\Models\Template;
use EONConsulting\Storyline2\Transformers\TemplateTransformer;
use Illuminate\Http\Request;
use mikehaertl\wkhtmlto\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Laracsv\Export;
use EONConsulting\Exports\Models\TaoResult;
use Carbon\Carbon;

class ExportsController extends Controller {

    public function wkhtml() {
        $host = request()->getHttpHost();

        $binary = str_replace(array('\'', '"'), '', env('WKHTMLTOPDF_BIN'));

        if ($host === 'localhost:8000') {
            $pdf = new Pdf([
                'commandOptions' => [
                    'useExec' => false,
                    'escapeArgs' => false,
                ],
            ]);

            $globalOptions = [
                'binary' => $binary,
                'no-outline', // Make Chrome not complain
                'margin-top' => 10,
                'margin-right' => 10,
                'margin-bottom' => 10,
                'margin-left' => 10,
                'javascript-delay' => 2000,
            ];
            $pdf->setOptions($globalOptions);
        } else {

            $pdf = new Pdf;
            $pdf->setOptions(
                    config('html-to-pdf')
            );
        }

        return $pdf;
    }

    public function modulePDF($courseId) {
        //ini_set('memory_limit', '2048M');
        //set_time_limit(2048);
        ini_set('max_execution_time', 2048);
        $course = Course::find($courseId);
        $Storyline2JSON = new Storyline2JSON;
        $storyline_id = $course->latest_storyline()->id;
        //$items = StorylineItem::with('contents')->where('storyline_id',$storyline_id)->get();
        $items = $Storyline2JSON->getTreeProgess($storyline_id);

        $course['template'] = Template::find($course->template_id);

        $view = view('exports::module.modulepdf', ['items' => $items, 'course' => $course]);
        $contents = $view->render();
        $pdf = $this->wkhtml();

        $pdf->addPage($contents);
        $pdf->addToc();

        if (!$pdf->saveAs(storage_path() . '/modules/' . $course->title . '.pdf')) {
            $res = 'error';
            $msg = $pdf->getError(); //$pdf->getCommand()->getOutput();
            $file = storage_path() . '/modules/' . $course->title . '.pdf';
        } else {
            $res = '200';
            $msg = ' Module <b>' . $course->title . '</b> was converted and saved as PDF successfully.';
            $file = storage_path() . '/modules/' . $course->title . '.pdf';
        }

        $response = array(
            'msg' => $msg,
            'course' => $courseId,
            'file' => $file,
            'res' => $res
        );

        return \Response::json($response);
    }

    public function downloadPDF($courseId) {
        $course = Course::find($courseId);
        $file = storage_path() . '/modules/' . $course->title . '.pdf';
        if (File::isFile($file)) {
            $file = File::get($file);
            $response = Response::make($file, 200);
            $response->header('Content-Type', 'application/pdf');

            return $response;
        } else {
            echo "<h2 style='color:red'>This file does not exit, please login as lecturer and save this module as PDF.</h2>";
        }
    }
    
    /**
     * 
     * @return Export
     */
    public function lara_csv(){
        $csvExporter = new Export;
        
        return $csvExporter;
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function export_marks(Request $request) {
        $courseId = (int)$request->get('course_id');
        $dt_frm = $request->get('dt_from');
        $dt_to = $request->get('dt_to');
        $marks = $this->get_tao_results($courseId, $dt_frm, $dt_to);
        if(empty($request->get('dt_from'))){ 
           $res = 'error';
           $msg = 'Please select period start date.';       
        }elseif(empty($request->get('dt_to'))){
            $res = 'error';
            $msg = 'Please select period end date.';
        }elseif($marks->isEmpty()){
             $res = 'error';    
             $msg = 'There were no records found.';  
        }else{
            $res = '200';    
            $msg = 'CSV file has been generated successfully.';  
        }
        
        $response = ['res' => $res,'msg' => $msg,'id'=>$courseId,
                     'from'=>$request->get('dt_from'),'to'=>$request->get('dt_to')];
        return \Response::json($response);        
    }
    
    public function get_tao_results($courseId,$dt_frm,$dt_to){
        $frm = Carbon::parse($dt_frm)->format('Y-m-d');
        $to  = Carbon::parse($dt_to)->format('Y-m-d');
        $storyline = Storyline::where(['course_id' => $courseId])->first();
        $storylineItem = StorylineItem::where(['storyline_id' => $storyline->id])->pluck('id');
        $marks = TaoResult::with('storyline_item', 'lti_user')
                            ->whereIn('storyline_item_id', $storylineItem)
                            ->WhereBetween('created_at', [$frm,$to])
                            ->groupBy('user_id')                   
                            ->orderBy('id')->get(); 
        
        return $marks;
        
    }
    
    /**
     * 
     * @param type $courseId
     * @param type $dt_frm
     * @param type $dt_to
     */
    public function csv_download($courseId,$dt_frm,$dt_to){       
        
        $marks = $this->get_tao_results($courseId, $dt_frm, $dt_to);        
        $csvExporter = $this->lara_csv();       
        $csvExporter->beforeEach(function ($marks) { 
             $marks->score = $marks->avg('score');
             $marks->test_taker = 'Assessment Type';
        });
        
       $csvExporter->build($marks,['lti_user.user_key' =>'Student ID',
                                   'lti_user.displayname' => 'Student Name',
                                   'test_taker' => 'Assessment Type','score' => 'Score'])
                   ->download('module-marks.csv'); 
       die();
    }

}
