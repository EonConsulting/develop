<?php
namespace EONConsulting\StoryCore\Controllers;

use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use EONConsulting\StoryCore\Classes\Flow\DBNestedSet\DBNestedSet;
use App\Models\Story;
use App\Models\Course;
use App\Models\Storyline;
use Illuminate\Http\Request;

class StoryCoreController extends LTIBaseController
{

    protected $hasLTI = false;

    public function index()
    {
        //return view('eon.lti::index', ['taxonomy' => $this->taxonomy->index()]);
    }

    public function storyitem()
    {
        //$nodes = new DBNestedSet\DBNestedSet('');
        $nodes->setBuildNestedArray();
        $nodes->save();
    }

    public function save_story_items()
    {
        $item = new Story;
        $item->storyline_id = $storyline->id;
        $item->name = $data->name;
        $item->type = $data->type;
        $item->parent_id = ($parent) ? $parent->id : null;

        $item->save();
    }


}