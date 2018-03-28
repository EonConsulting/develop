<?php

namespace EONConsulting\Exports\Http\Controllers;

use App\Http\Controllers\Controller;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Exports\Jobs\BulkPdfExportJob;
use Illuminate\Support\Facades\Auth;

class ExportCoursePdfController extends Controller
{

    /**
     * Generate a full course html export
     *
     * @param \EONConsulting\Storyline2\Models\Course $course
     */
    public function generate(Course $course)
    {
        BulkPdfExportJob::dispatch($course);

        $message = 'Export started, files will be available for download soon.';

        return redirect()->route('courses', [])->with('flash.success', $message);
    }

}