<?php
/**
 * Created by PhpStorm.
 * User: bmmuffy
 * Date: 2017/02/17
 * Time: 9:06 AM
 */

namespace EONConsulting\Graphs\Http\Controllers;


use App\Models\User;
use EONConsulting\Graphs\src\Models\GraphModel;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use App\Http\Controllers\Controller;
use EONConsulting\LaravelLTI\Models\UserLTILink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\GraphViz\Graph;


class TestStencilController extends Controller
{

    protected $hasLTI = false;

    /**
     * @param GraphsDomainOBJ $graphsDomainOBJ
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function graph_response(GraphsDomainOBJ $graphsDomainOBJ) {
        $graphs = $graphsDomainOBJ->__graphs(new GraphModel);
        return view('ph::index', ['graphs' => $graphs->all()]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function init(GraphsDomainOBJ $graphsDomainOBJ, $id) {
        // Todo:: Respond based on View
        $graph = $graphsDomainOBJ->__graphs(GraphModel::find($id));
        return view('ph::learnergraph', ['graph' => $graph]);
    }

    public function save(Request $request)
    {
        $code = $request->get('textareaCode');
        $name = $request->get('graphName');


        if (!empty($code && $name)) {

            //Select Model
            $q = new GraphModel;
            $q->code = $code;
            $q->name = $name;
            $q->save();

            //dd($q);

            session()->flash('success_message', 'A New Graph has been Saved ..');
            return redirect()->back();

        } else {
            echo "ERROR: Save Request could not be executed";
        }
        //return view('ph::lecturer');
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

    public function lecturer(Request $request) {

        $user = $request->user()->id;
        $ltiuser = UserLTILink::where('user_id', '=', $user)->first();
        $role = $ltiuser->roles;

        if($role == 'Instructor')  {

            return view('ph::lecturergraph');

        } else {

            $graph = GraphModel::orderBy('created_at', 'desc')->first();

            return view('ph::learnergraph', ['graph' => $graph]);

        }

    }
}