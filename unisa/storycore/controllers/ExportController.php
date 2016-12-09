<?php namespace Unisa\Storycore\Controllers;

use Backend\Classes\Controller;
use Unisa\Assets\Models\Asset;
use Unisa\Pages\Models\Page;
use Unisa\Storycore\Models\Storycore as StoryModel;
use BackendMenu;
use Backend;
use BackendAuth;
use Input;
use ZipArchive;
use Db;
use ApplicationException;


/**
 * Export Controller Back-end Controller
 */
class ExportController extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Unisa.Storycore', 'storycore', 'exportcontroller');
    }

    /**
     * Export the selected storyline to zip file
     * @return type
     */
    public function onExport(){
        $stories = Input::get('checked');
        if(count($stories) >1){
            throw new ApplicationException('Please select maximum one storyline');
        }
        $downloadPath = 'uploads/temp_export/'.BackendAuth::getUser()->id;
        $archive_file = $downloadPath.'/'.rand(11111,99999).'.zip';
        if(!is_dir($downloadPath)){
            mkdir($downloadPath, 0777, true);
        }

        $zip = new ZipArchive;
        if ($zip->open($archive_file, ZIPARCHIVE::CREATE )) {
            $xmlName = '';
            /**
             * Creating the content to be written in xml file
             */
            foreach ($stories as $story) {
                $storyDetails = StoryModel::find($story);
                $xmlName = $storyDetails->id.'.xml';
                $pages = Db::table('unisa_storycore_story_pages')->where('storycore_id', $story)->select('page_id')->get();
                
                foreach ($pages as $key=>$page) {
                    $pageDetails = Page::find($page->page_id);
                    $assets = Db::table('unisa_pages_page_assets')->where('page_id', $page->page_id)->select('asset_id')->get();
                    $xmlAsset = '';
                    foreach ($assets as $asset) {
                        $assetDetails = Asset::find($asset->asset_id);
                        $assetFile = 'assets/'.BackendAuth::getUser()->id.'/'.$assetDetails->file_name.'.htm';

                        /**
                         * Adding asset files in zip
                         */
                        if(file_exists($assetFile)){
                            $zip->addFile($assetFile,'assets/'.$assetDetails->file_name.'.htm');
                        }
                        
                    }   
                }  
            }
            $zip->addFile('assets/'.$xmlName,$xmlName);
            $zip->close();

            /**
             * return download URL in ajax response
             */
            return (Backend::url('unisa\storycore\storycore\download?file='.basename($archive_file)));
            

        }
        //add each files of $file_name array to archive
    }

    /**
     * Code to 
     * @return [type] [description]
     */
    public function download(){
        $archive_file = 'uploads/temp_export/'.BackendAuth::getUser()->id.'/'.Input::get('file');
        header('Content-type: application/zip');
        header('Content-Disposition: attachment; filename="'.basename($archive_file).'"');
        header("Content-length: " . filesize($archive_file));
        header("Pragma: no-cache");
        header("Expires: 0");
        ob_clean();
        flush();
        readfile($archive_file);
        unlink($archive_file);
        exit;
    }
}