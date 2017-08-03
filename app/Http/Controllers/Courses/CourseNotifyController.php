<?php

namespace App\Http\Controllers\Courses;

use App\Jobs\SendCourseNotificationEmail;
use App\Mail\CourseNotificationEmail;
use App\Models\Course;
use App\Models\CourseUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class CourseNotifyController extends Controller {

    public function index(Course $course) {

        $breadcrumbs = [
            'title' => 'Modules',
            'href' => route('courses'),
            'child' => [
                'title' => 'Manage '.$course->title,
                'href' => route('courses.single', $course->id),
                'child' => [
                    'title' => 'Notify Users'
                ],
            ],
        ];

        return view('lecturer.courses.notify', ['course' => $course, 'breadcrumbs' => $breadcrumbs]);
    }

    public function store(Request $request, Course $course) {
        $emails = json_decode($request->all()['emails']);

        for($i = 0; $i < count($emails); $i++) {
            $email = $emails[$i];
            $course_user = CourseUser::firstOrNew([
                'course_id' => $course->id,
                'email' => $email
            ]);
            $course_user->save();
            Mail::to($email)->send(new CourseNotificationEmail($course_user, $course));
        }

        session()->flash('success_message', 'Those users will be notified shortly.');
        return redirect()->back();
    }

    public function getUsers(Course $course) {
        $users = $course->users()->pluck('email')->toArray();
        return $users;
    }

}
