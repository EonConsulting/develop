<?php

namespace EONConsulting\Core\Helpers;

use Storage;
use EONConsulting\Core\Helpers\HtmlToDom\HtmlHandler;
use EONConsulting\Core\Helpers\HtmlToDom\SimpleHtmlDom;

class CourseExportHelper
{

    static public function hasHtmlCourse($course_id)
    {
        $filename = "exports/full-html-course/course-{$course_id}.zip";

        return Storage::disk('storage')->exists($filename);
    }

    static public function getHtmlZipFile($course_id)
    {
        return "exports/full-html-course/course-{$course_id}.zip";
    }

    static public function getSinglePdfPath($storyline_item)
    {
        $course_id = optional($storyline_item->storyline)->course_id;

        return "exports/single-pdf/{$course_id}/{$storyline_item->id}/item.pdf";
    }


    static public function removeJavaScript($body = null)
    {
        if(is_null($body))
        {
            return null;
        }

        if( ! $html = HtmlHandler::strGetHtml($body))
        {
            return $body;
        }

        if( ! $html->find("script"))
        {
            return (string) $body;
        }

        foreach($html->find("script") as $js)
        {
            if( ! $js->hasAttribute('src'))
            {
                $js->outertext = '';
            }
        }

        return (string) $html;
    }



}