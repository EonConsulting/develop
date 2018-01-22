<?php

namespace EONConsulting\Exports\Http\Controllers;

use App\Http\Controllers\Controller;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Storyline2\Models\Storyline;
use EONConsulting\Storyline2\Models\StorylineItem;
use EONConsulting\Student\Progression\Http\Controllers\DefaultController as StudentProgress;
use App\Models\ContentTemplates;
use Illuminate\Http\Request;
use mikehaertl\wkhtmlto\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class ExportsController extends Controller {
    
    
    public function wkhtml() {
        $pdf = new Pdf([
            'commandOptions' => [
                'useExec' => false,
                'escapeArgs' => false,
            ],
        ]);
        
        $globalOptions = array(           
            'no-outline',// Make Chrome not complain
            'page-size' => 'Letter' //Default page options
        );
        
        $pdf->setOptions($globalOptions);
        
        $binary = str_replace(array('\'', '"'), '',env('WKHTMLTOPDF_BIN'));
        
        $pdf->binary = $binary;

        return $pdf;
    }
        
    public function modulePDF($courseId) {
        $course = Course::find($courseId);
        $StudentProgress = new StudentProgress;
        $storyline_id = $course->latest_storyline()->id;
        $items = StorylineItem::with('contents')->where('storyline_id',$storyline_id)->get();
        $items = $StudentProgress->items_to_tree($items);
        $course['template'] = ContentTemplates::find($course->template_id);
        
        $view = view('exports::module.modulepdf', ['items' => $items,'course'=>$course]);
        $contents = $view->render();
        
        $pdf = $this->wkhtml();
        
        
        $pdf->addPage($contents);
        $pdf->addToc();
        
        if (!$pdf->saveAs(storage_path() . '/modules/'. $course->title . '.pdf')) {
            $res = 'error';
            $msg = $pdf->getError();
            $file = storage_path() . '/modules/'. $course->title . '.pdf';
 
        } else {            
            $res = '200';
            $msg = ' Module <b>'.$course->title.'</b> was converted to PDF successfully.';
            $file = storage_path() . '/modules/'. $course->title . '.pdf';
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
        }
    }
    
}