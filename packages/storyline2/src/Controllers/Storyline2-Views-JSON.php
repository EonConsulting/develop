<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/19
 * Time: 9:21 AM
 */

namespace EONConsulting\Storyline2\Controllers;

use Illuminate\Routing\Controller as BaseController;
//use EONConsulting\Storyline2\Models\Course;
use App\Models\Course;
use App\Models\Storyline;
use App\Models\StorylineItem;


class Storyline2ViewsJSON extends BaseController {
    
    public function index() {
        //TODO: get course tree and use instead of the following demo array

        //hardcoded for design
        
        $example_course = [
            [
                'id' => '0',
                'text' => 'Introduction',
                'icon' => '/',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false
                ],
                'children' => [
                    'Welcome',
                    'Course Outline',
                    'Prescribed Textbook',
                    'Assessment Plan'
                ],
                'li_attr' => [],
                'a_attr' => []
            ],[
                'id' => '1',
                'text' => 'Topic',
                'icon' => '/',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false
                ],
                'children' => [
                    [
                        'id' => '2',
                        'text' => 'Topic',
                        'icon' => '/',
                        'state' => [
                            'opened' => false,
                            'disabled' => false,
                            'selected' => false
                        ],
                        'children' => [
                            'Subtopic 1',
                            'Subtopic 2',
                            'Subtopic 3',
                            'Subtopic 4'
                        ],
                        'li_attr' => [],
                        'a_attr' => []
                    ],[
                        'id' => '3',
                        'text' => 'Topic',
                        'icon' => '/',
                        'state' => [
                            'opened' => false,
                            'disabled' => false,
                            'selected' => false
                        ],
                        'children' => [
                            'Subtopic 1',
                            'Subtopic 2',
                            'Subtopic 3',
                            'Subtopic 4'
                        ],
                        'li_attr' => [],
                        'a_attr' => []
                    ],[
                        'id' => '4',
                        'text' => 'Topic',
                        'icon' => '/',
                        'state' => [
                            'opened' => false,
                            'disabled' => false,
                            'selected' => false
                        ],
                        'children' => [
                            'Subtopic 1',
                            'Subtopic 2',
                            'Subtopic 3',
                            'Subtopic 4'
                        ],
                        'li_attr' => [],
                        'a_attr' => []
                    ]
                ],
                'li_attr' => [],
                'a_attr' => []
            ]

        ];



        return response()->json($example_course);
       
    } 

    public function render(Course $course) {  
        
        $var = $course::find(14);      
        $storyline = $var->latest_storyline();
        $items = $storyline->items;       
        //dd(json_encode($items));
        $decoded = json_encode($items);
        return $decoded;
              
    } 
    
   
    

}
