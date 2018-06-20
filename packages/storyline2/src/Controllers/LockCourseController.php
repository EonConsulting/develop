<?php

namespace EONConsulting\Storyline2\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\Storyline2\Models\Course;
use Illuminate\Database\Eloquent\Model;

class LockCourseController extends Controller
{

    /**
     * Lock the course
     *
     * @param  \EONConsulting\Storyline2\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function store(Course $course)
    {
        if( ! $course->lock())
        {
            session()->flash('flash.error', 'You may not lock this course because you are not the creator.');

            return redirect()->back();
        }

        session()->flash('flash.success', 'Course have been locked, no one will be able to edit it until you unlock it.');

        return redirect()->back();
    }

    /**
     * Unlock the course
     *
     * @param  \EONConsulting\Storyline2\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if( ! $course->unlock())
        {
            session()->flash('flash.error', 'You may not unlock this course because you are not the creator.');

            return redirect()->back();
        }

        session()->flash('flash.success', 'Course have been unlocked, anyone can now edit it again.');

        return redirect()->back();
    }
}