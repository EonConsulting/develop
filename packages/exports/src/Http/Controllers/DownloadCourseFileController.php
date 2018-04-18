<?php

namespace EONConsulting\Exports\Http\Controllers;

use App\Http\Controllers\Controller;
use EONConsulting\Exports\Models\FileExport;
use Illuminate\Http\Response;
use Storage;

class DownloadCourseFileController extends Controller
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

        return Response::stream_file($file->filesystem, $file->filename);
    }

}