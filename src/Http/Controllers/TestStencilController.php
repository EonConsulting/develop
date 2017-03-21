<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/17
 * Time: 9:06 AM
 */

namespace EONConsulting\Graphs\Http\Controllers;


use EONConsulting\Graphs\src\Models\Graph;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use App\Http\Controllers;
use Illuminate\Http\Request;


class TestStencilController extends LTIBaseController
{

    protected $hasLTI = false;

    public function save(Request $request)
    {
        $code = $request->get('textareaCode');
        $name = $request->get('graphName');


        if (!empty($code && $name)) {

            //Select Model
            $q = new Graph;
            $q->code = $code;
            $q->name = $name;
            $q->save();

            //dd($q);

            return redirect()->back()
;
        } else {
            echo "ERROR: Request could not be executed";
        }
        return view('ph::lecturer');
    }

    public function tested()
    {
        //   echo 'test';
        return view('ph::goodbye');

    }

    public function testing()
    {
        //   echo 'test';
        return view('ph::lecturer');

    }
}