<?php

namespace EONConsulting\Exports\Http\Controllers;

use App\Http\Controllers\Controller;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Exports\Jobs\CourseExportJob;
use Illuminate\Support\Facades\Auth;

class ExportCourseHtmlController extends Controller
{

    /**
     * Generate a full course html export
     *
     * @param \EONConsulting\Storyline2\Models\Course $course
     */
    public function generate(Course $course)
    {
        $user = Auth::user();

        CourseExportJob::dispatch($user, $course);

        $message = 'Export started, file will be available for download soon.';

        return redirect()->route('courses', [])->with('flash.success', $message);
    }

}