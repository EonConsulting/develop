<?php

namespace EONConsulting\Exports\Http\Controllers;

use App\Http\Controllers\Controller;
use EONConsulting\Exports\Models\FileExport;
use EONConsulting\Storyline2\Models\Course;
use Illuminate\Http\Response;
use Storage;

class DownloadCoursePdfController extends Controller
{

    /**
     * Download the requested file
     *
     * @param \EONConsulting\Exports\Models\FileExport $file
     * @return \Illuminate\Http\Response
     */
    public function show(FileExport $file)
    {
        if( ! Storage::disk($file->filesystem)->exists($file->filename))
        {
            return redirect()->route('lti.courses', [])->with('flash.error', 'Unable to download file.');
        }

        $filename_override = '';

        if($course = Course::find($file->exportable_id))
        {
            $filename_override = str_slug($course->title) . '.pdf';
        }

        return Response::stream_file($file->filesystem, $file->filename, $filename_override);
    }

}