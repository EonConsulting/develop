<?php
/**
 * Created by PhpStorm.
 * User: Peace-N | vamoose
 * Date: 7/22/2017
 * Time: 12:26 PM
 */
namespace App\Http\Controllers\Courses;

use App\Models\Course;
use App\Models\Storyline;
use App\Models\StorylineItem;
use EONConsulting\Storyline\Core\Flow\DBTaxonomy\DBCourseStorylineBase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class CourseStorylineController
 * @package App\Http\Controllers\Courses
 */
class CourseStorylineController extends DBCourseStorylineBase
{

    /**
     * @var $storylineId
     */
    protected $storylineId;

    /**
     * @param Course $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Course $course)
    {
        // MH: replaced by storyline2 package
            /* $breadcrumbs = [
            'title' => 'Modules',
            'href' => route('courses'),
            'child' => [
                'title' => 'Manage '.$course->title,
                'href' => route('courses.single', $course->id),
                'child' => [
                    'title' => 'Storyline Builder',
                ],
            ],
        ];

        return view('lecturer.storylines.single', ['course' => $course, 'breadcrumbs' => $breadcrumbs]);
             * 
             */
    }
    /**
     * @param Request $request
     * @param Course $course
     * @return \Illuminate\Contracts\Routing\ResponseFactory|mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function storeback(Request $request, Course $course){
        $this->setNodes($request);
        $this->setstId(Storyline::where('course_id', '=', $course->id)->first());
        return $this->asset_store($request, $course);
    }

     public function store(Request $request, Course $course) {
        //Check If Course has a Storyline and do an Update else Create a New Storyline
        $nodes = $request->all()['parts'];
        $data = json_decode($nodes, true);
        $stId = Storyline::where('course_id', '=', $course->id)->first();
        if ($stId == null) {
            $storyline = new Storyline;
            $storyline->course_id = $course->id;
            $storyline->creator_id = $request->user()->id;
            $storyline->save();
            $this->save_storyline_items($storyline,$data);
        } else {
            $stId->update();
            $this->save_storyline_items($stId,$data);

        }
        return response('The Storyline has been Saved', 200);
    }

    /**
     * @param $storyline
     * @param $data
     */
    public function save_storyline_items($storyline, $data)
    {
        $this->asset_save_storyline_items($storyline, $data);
    }

    /**
     * Fix a Tree with Existing Parent::Child Relationship in DB
     * Tree Fixing Component
     * @return mixed
     */
    public function fixtree()
    {
        //Fixed Scoped Tree
        return StorylineItem::scoped(['storyline_id' => 55])->fixTree();
    }

    /**
     * FETCH Latest Storyline
     * @param Course $course
     * @return mixed|string
     */
    public function fetch(Course $course)
    {
       return $this->asset_fetch($course);
    }

    /**
     * @param array $elements
     * @param $childIten
     * @return array|mixed
     */
    public function get_feed_items(array $elements, $childIten)
    {
        return $this->asset_get_feed_items($elements, $childIten);
    }

    /**
     * @param Course $course
     * @return array|mixed
     */
    public function get(Course $course)
    {
        return $this->asset_get($course);
    }

    /**
     * @param array $elements
     * @param bool $parentId
     * @return array|mixed
     */
    protected function get_storyline(array $elements, $parentId = false)
    {
        return $this->asset_get_storyline($elements, $parentId);
    }

}
