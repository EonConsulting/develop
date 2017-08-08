<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:36 AM
 */

namespace EONConsulting\PHPStencil\src\Factories\WebService\REST\Controllers;


use EONConsulting\PHPStencil\src\Models\DummyTable;
use Illuminate\Http\Request;

class RestController extends RestBaseController {

    public function __construct() {

    }

    function delete(Request $request, $id) {
        $dummy = $this->get_dummy_record($id);
        if(!$dummy) {
            return response()->json($this->return_error(['Item does not exist.']));
        }

        $dummy->delete();

        return response()->json($this->return_success(['Item deleted.']));
    }

    function get(Request $request, $id) {
        $dummy = $this->get_dummy_record($id);
        if(!$dummy) {
            return response()->json($this->return_error(['Item does not exist.']));
        }
        return response()->json($this->return_success(['Item available.'], $dummy->toArray()));
    }

    function post(Request $request, $id) {
        $dummy = $this->get_dummy_record($id);
        if(!$dummy) {
            return response()->json($this->return_error(['Item does not exist.']));
        }

        $dummy->title = ($request->input('title')) ? $request->input('title') : $dummy->title;
        $dummy->body = ($request->input('body')) ? $request->input('body') : $dummy->body;
        $dummy->slug = ($request->input('slug')) ? $request->input('slug') : $dummy->slug;
        $dummy->save();

        return response()->json($this->return_success(['Item updated.'], $dummy->toArray()));
    }

    function put(Request $request) {
        if($request->title == "" && $request->body == "" && $request->slug == "") {
            return response()->json($this->return_error(['At least one field is required.']));
        }

        $item = DummyTable::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'slug' => $request->input('slug')
        ]);

        return response()->json($this->return_success(['Item created.'], ['item' => $item]));
    }

    private function get_dummy_record($id) {
        return DummyTable::where('id', $id)->first();
    }

}