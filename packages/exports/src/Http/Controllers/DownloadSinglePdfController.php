<?php

namespace EONConsulting\Exports\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use EONConsulting\Storyline2\Models\StorylineItem;
use Storage;

class DownloadSinglePdfController extends Controller
{

    /**
     * Download the requested file
     *
     * @param \EONConsulting\Storyline2\Models\StorylineItem $storyline_item
     * @return \Illuminate\Http\Response
     */
    public function show(StorylineItem $storyline_item)
    {
        if( ! $file = $storyline_item->exported_file)
        {
            return response()->json(['message' => 'Unable to download file.'], 422);
        }

        if( ! Storage::disk($file->filesystem)->exists($file->filename))
        {
            return response()->json(['message' => 'Unable to download file.'], 422);
        }

        $filename_override = str_slug($storyline_item->name) . '.pdf';

        return Response::stream_file($file->filesystem, $file->filename, $filename_override);
    }

}