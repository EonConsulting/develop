<?php

namespace EONConsulting\Storyline2\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Notifications\Notifications\Courses\CourseNotifier;

class CourseNotifyController extends Controller
{

    public function store(Request $request)
    {

        if( ! $course = Course::find($request->get('course_id')))
        {
            session()->flash('error_message', 'Unable to find course!');

            return redirect()->back();
        }

        if( ! $notification_types = $request->get('options'))
        {
            session()->flash('error_message', 'No option selected!');

            return redirect()->back();
        }

        $message = $request->get('message');

        foreach($course->users()->get() as $user)
        {
            $user->notify(
                new CourseNotifier($course, $notification_types, $message)
            );
        }

        session()->flash('success_message', 'Those users will be notified shortly.');

        return redirect()->back();
    }
}
