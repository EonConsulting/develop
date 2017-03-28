<?php
/**
 * Created by PhpStorm.
 * User: bmmuffy
 * Date: 2017/02/17
 * Time: 9:06 AM
 */

namespace EONConsulting\Graphs\Http\Controllers;


use EONConsulting\Graphs\src\Models\GraphModel;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use App\Http\Controllers;
use Illuminate\Http\Request;


class TestStencilController extends LTIBaseController
{

    protected $hasLTI = false;

    public function save(Request $request)
    {
        $code = $request->get('textareaCode');
      //  $name = $request->get('graphName');


        if (!empty($code && $name)) {

            //Select Model
            $q = new GraphModel;
            $q->code = $code;
            $q->name = $name;
            $q->save();

            //dd($q);

            return redirect()->back();
        } else {
            echo "ERROR: Request could not be executed";
        }
        return view('ph::lecturer');
    }

    public function fixed()
    {
        //   fixed graph
        return view('ph::welcomed');

    }

    public function interactive()
    {
        //   interactive graph
        return view('ph::goodbye');

    }
        public function lecturer()
    {
                //   Lecturer graph
        return view('ph::goodbye');

    }
}