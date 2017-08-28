<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/22
 * Time: 7:11 AM
 */

namespace EONConsulting\FileManager\Http\Controllers;


use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;

class FileManagerController extends LTIBaseController {

    protected $hasLTI = false;

    public function index() {
        return view('eon.filemanager::ckfinder');
    }

//    public function index() {
//
//        $dir_arr = $this->dirToArray(public_path('/vendor/storyline/'));
//        $html = $this->get_tree_html($dir_arr);
//
//        return view('eon.filemanager::index', ['html' => $html]);
//    }
//
    public function update(Request $request) {
        $page = request()->get('page');
        if(!$page) {
            return redirect()->back();
        }

//        dd($request->get('data'));

        $ext = pathinfo($page, PATHINFO_EXTENSION);
        $file_name = pathinfo($page, PATHINFO_FILENAME) . '-' . time() . '.' . $ext;

        if(!copy(public_path($page), public_path($file_name))) {
            return response()->json(['success' => false, 'success_message' => 'Page could not save.']);
        }

//        $contents = file_get_contents ($page);
//        $contents = preg_replace("/<body[^>]*>(.*?)<\\/body>/is", $request->get('data'), $contents);
//        file_put_contents($page, $contents);

        $file = fopen(public_path($page), "w");
        fwrite($file, $request->get('data'));
        fclose($file);
        return response()->json(['success' => true, 'success_message' => 'Page saved.']);
    }
//
//    function get_tree_html($data = []) {
//        $html = '';
//        foreach($data as $key => $value) {
//
//            if(is_array($value)) {
//                if(array_key_exists('item', $value) && array_key_exists('path', $value)) {
//                    $html .= '<li data-jstree=\'{"icon":"fa fa-file-code-o"}\' data-uniqueid="' . $value['rand_id'] . '" data-path="' . str_replace('///', '/', str_replace('//', '/', str_replace(public_path(), '', $value['path']))) . '" data-item="' . $value['item'] . '">' . $value['item'] . '</li>';
//                } else {
//                    $html .= '<li data-jstree=\'{"icon":"glyphicon glyphicon-folder"}\'>' . $key . '<ul>';
//                    $html .= $this->get_tree_html($value);
//                    $html .= '</ul></li>';
//                }
//            } else {
////                $html .= '<li data-icon-cls="treeview-icon icon-txt">' . $value . '</li>';
//            }
//        }
//
//        return $html;
//    }
//
//    function dirToArray($dir, $path = '') {
//
//        $result = array();
//
//        $cdir = scandir($dir);
//        foreach ($cdir as $key => $value) {
//            if (!in_array($value,array(".",".."))) {
//                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
//                    $result[$value] = $this->dirToArray($dir . DIRECTORY_SEPARATOR . $value, $dir . DIRECTORY_SEPARATOR . $value);
//                } else {
//                    $result[] = ['rand_id' => uniqid(), 'item' => $value, 'path' => $path];
//                }
//            }
//        }
//
//        return $result;
//    }

}