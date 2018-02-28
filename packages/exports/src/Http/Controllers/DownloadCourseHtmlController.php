<?php

namespace EONConsulting\Exports\Http\Controllers;

use App\Http\Controllers\Controller;
use EONConsulting\Core\Helpers\CourseExportHelper;
use EONConsulting\Storyline2\Models\Course;
use Illuminate\Http\Response;
use Storage;

class DownloadCourseHtmlController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param \EONConsulting\Storyline2\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $filename = CourseExportHelper::getHtmlZipFile($course->id);

        if( ! Storage::disk('storage')->exists($filename))
        {
            return redirect()->route('courses', [])->with('flash.error', 'Unable to download file.');
        }

        return Response::stream_file('storage', $filename);
    }

}