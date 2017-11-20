<?php

namespace EONConsulting\Storyline2\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Storyline2\Models\CourseUser;
use App\Notifications\CourseNotifier;

class CourseNotifyController extends Controller
{

    public function store(Request $request)
    {

        if( ! $course_id = $request->get('course_id'))
        {
            session()->flash('error_message', 'Unable to find course!');

            return redirect()->back();
        }

        if( ! $course = Course::find($course_id))
        {
            session()->flash('error_message', 'Unable to find course!');

            return redirect()->back();
        }

        $notification_types = [];

        if($request->get('email') == 'true')
        {
            $notification_types[] = 'mail';
        }

        if($request->get('sms') == 'true')
        {
            $notification_types[] = 'nexmo';
        }

        foreach($course->users()->get() as $user)
        {
            $user->notify(
                new CourseNotifier($course, $notification_types)
            );
        }

        session()->flash('success_message', 'Those users will be notified shortly.');

        return redirect()->back();
    }


}
