<?php

namespace EONConsulting\Exports\Http\Controllers;

use App\Http\Controllers\Controller;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Storyline2\Models\Storyline;
use EONConsulting\Storyline2\Models\StorylineItem;
use EONConsulting\Storyline2\Controllers\Storyline2ViewsJSON as Storyline2JSON;
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

        $globalOptions = [
            //'binary' => '/usr/bin/wkhtmltopdf',
            'no-outline', // Make Chrome not complain
            'margin-top' => 10,
            'margin-right' => 10,
            'margin-bottom' => 10,
            'margin-left' => 10,
            //'javascript-delay' => 2000,
            // Explicitly tell wkhtmltopdf that we're using an X environment
            'use-xserver',
            // Enable built in Xvfb support in the command
            'commandOptions' => array(
                'enableXvfb' => true,
                // Optional: Set your path to xvfb-run. Default is just 'xvfb-run'.
                'xvfbRunBinary' => '/usr/bin/xvfb-run --server-args="-screen 0, 1920x1080x24',
                // Optional: Set options for xfvb-run. The following defaults are used.
                'xvfbRunOptions' => '--auto-servernum',
            ),
        ];

        $pdf->setOptions($globalOptions);
        $binary = str_replace(array('\'', '"'), '', env('WKHTMLTOPDF_BIN'));
        $pdf->binary = $binary;

        return $pdf;
    }

    public function modulePDF($courseId) {
        $course = Course::find($courseId);
        $Storyline2JSON = new Storyline2JSON;
        $storyline_id = $course->latest_storyline()->id;
        //$items = StorylineItem::with('contents')->where('storyline_id',$storyline_id)->get();
        $items = $Storyline2JSON->getTreeProgess($storyline_id);

        $course['template'] = ContentTemplates::find($course->template_id);

        $view = view('exports::module.modulepdf', ['items' => $items, 'course' => $course]);
        $contents = $view->render();

        $pdf = $this->wkhtml();

        $pdf->addPage($contents);
        $pdf->addToc();

        if (!$pdf->saveAs(storage_path() . '/modules/' . $course->title . '.pdf')) {
            $res = 'error';
            $msg = $pdf->getError();
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

    public function downloadPDF2($courseId) {
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
