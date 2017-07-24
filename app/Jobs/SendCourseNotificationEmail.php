<?php

namespace App\Jobs;

use App\Mail\CourseNotificationEmail;
use App\Models\Course;
use App\Models\CourseUser;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendCourseNotificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $course;
    protected $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Course $course, $email) {
        $this->course = $course;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {

        $course_user = CourseUser::where('course_id', $this->course->id)->where('email', $this->email)->first();

        Mail::send(new CourseNotificationEmail($course_user, $this->course));
    }
}
