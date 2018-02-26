<?php

/* Author: Michael Hanekom
 * Date: 2017-11-30
 * Class to centralize all processing for assets
 */

namespace EONConsulting\Core\Classes;

use App\Models\AssetRegister;

class Assets {

    public function __construct() {
        
    }

    public function BuildAssetRegister($course_id, $storyline_id) {
        // first check if there is an asset register
        $asset_register = $this->GetAssetRegisterForCourse($course_id);

        if (count($asset_register) <= 0) {
            // get all storyline items
            $SL = new Storylines();
            $items = $SL->GetStorylineItems($storyline_id);
            $sorted_items = $SL->TransformStorylineItemsToFlatArray($items);
            $content_ids = array_column($sorted_items, "content_id");

            // we are tallying counts here, but we are also going to build a register
            // of entries so that we can detect progress in the GetAssetProgressPercentage method
            $video_count = 1;
            $video_register = [];
            $ebook_count = 1;
            $ebook_register = [];

            // youtube embeds via <iframe src="https://www.youtube.com/embed/MicK6SAP></iframe>
            // vimeo embeds via <iframe src="https://player.vimeo.com/video/23608259></iframe>
            // uploaded videos embed via <video> <source src="movie.mp4" type="video/mp4"> </video>
            // ebooks embed via <a href="ebook.epub">
            // pdf embed via <a href="book.pdf">


            $Cnt = new Content();
            foreach ($content_ids as $ci) {
                if ($ci) {
                    $body = $Cnt->GetContentBody($ci);

                    $html = \EONConsulting\Core\Helpers\HtmlToDom\HtmlHandler::strGetHtml($body);

                    $video_assets = $this->ParseHtmlForVideoAssets($html, $video_count);
                    $ebook_assets = $this->ParseHtmlForEbookAssets($html, $ebook_count);

                    // adjust the counts
                    $video_count = $video_count + count($video_assets);
                    $ebook_count = $ebook_count + count($ebook_assets);

                    // append the arrays of objects
                    $video_register = array_merge($video_register, $video_assets);
                    $ebook_register = array_merge($ebook_register, $ebook_assets);
                }
            }

            // insert the final record into the asset_register
            $new_ar = new AssetRegister();
            $new_ar->course_id = $course_id;
            $new_ar->storyline_id = $storyline_id;
            $new_ar->video_count = $video_count;
            $new_ar->video_register = json_encode($video_register);
            $new_ar->ebook_count = $ebook_count;
            $new_ar->ebook_register = json_encode($ebook_register);
            $new_ar->save();

            // read the new entry
            $asset_register = $this->GetAssetRegisterForCourse($course_id);
        }

        return $asset_register;
    }

    public function GetAssetProgressPercentage($course_id, $storyline_item) {
        // fetch the content of this topic into an HTML object
        // so that we can collect all the embedded items
        $SLI = new StorylineItems();
        $content = $SLI->GetStorylineItemContent($storyline_item);
        $html = \EONConsulting\Core\Helpers\HtmlToDom\HtmlHandler::strGetHtml($content);
        $video_items = $this->ParseHtmlForVideoAssets($html);
        $ebook_items = $this->ParseHtmlForEbookAssets($html);

        // build collection of videos and ebooks in this
        // particular piece of content
        // we have to look at the video_register and ebook_register
        // within the asset_register in order to see where in the collection
        // this item places
        $asset_register = $this->GetAssetRegisterForCourse($course_id);
        $video_register = json_decode($asset_register->video_register);
        $ebook_register = json_decode($asset_register->ebook_register);

        // parse the register and find the LAST video or ebook item
        // since we have to give them the benefit of the doubt
        // position and src
        // default so things dont break
        $matching_video_position = 0;
        $end_video_position = 0;
        $video_percent = 0;
        if (count($video_register) > 0) {
            $matching_video_key = array_search(end($video_items), array_column($video_register, 'src'));
            if ($matching_video_key !== false) {
                $matching_video_position = $video_register[$matching_video_key]['position'];
                $end_video_position = end($video_register)['position'];
                $video_percent = number_format($matching_video_position / $end_video_position * 100, 2, '.', '');
            }
        }

        // default so things dont break
        $matching_ebook_position = 0;
        $end_ebook_position = 0;
        $ebook_percent = 0;
        if (count($ebook_register) > 0) {
            // position and href
            $matching_ebook_key = array_search(end($ebook_items), array_column($ebook_register, 'href'));
            if ($matching_ebook_key !== false) {
                $matching_ebook_position = $ebook_register[$matching_ebook_key]['position'];
                $end_ebook_position = end($ebook_register)['position'];
                $ebook_percent = number_format($matching_ebook_position / $end_ebook_position * 100, 2, '.', '');
            }
        }

        return [
            "video_percent" => $video_percent,
            "ebook_percent" => $ebook_percent
        ];
    }

    public function GetAssetRegisterForCourse($course_id) {
        // should return a bunch of rows with different mime-types
        // and counts
        $ar = AssetRegister::where('course_id', $course_id)
                ->first();

        return $ar;
    }

    function ParseHtmlForVideoAssets($html, $count = 1) {

        $result = [];

        // find youtube and vimeo
        foreach ($html->find('iframe') as $iframe) {
            // youtube videos
            $src = $iframe->getAttribute('src');
            if (strpos($src, 'youtube.com') !== false) {
                $result[] = [
                    "position" => $count++,
                    "src" => $src
                ];
            }
            if (strpos($src, 'vimeo.com') !== false) {
                $result[] = [
                    "position" => $count++,
                    "src" => $src
                ];
            }
        }
        // find mp4
        foreach ($html->find('video source') as $video) {
            $src = $video->getAttribute('src');
            if (strpos($src, '.mp4') !== false) {
                $result[] = [
                    "position" => $count++,
                    "src" => $src
                ];
            }
        }

        return $result;
    }

    function ParseHtmlForEbookAssets($html, $count = 1) {
        $result = [];

        // find ebooks
        foreach ($html->find('a') as $ebook) {
            $href = $ebook->getAttribute('href');
            if (strpos($href, '.epub') !== false) {
                $result[] = [
                    "position" => $count++,
                    "href" => $href
                ];
            }
        }

        return $result;
    }

}
