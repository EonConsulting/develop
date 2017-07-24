<?php

namespace App\Mail;

use App\Models\Course;
use App\Models\CourseUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CourseNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $course;
    protected $course_user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CourseUser $course_user, Course $course) {
        $this->course = $course;
        $this->course_user = $course_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('dont-reply@unisaonline.net')->view('emails.courses.notifications.notify')->with(['course' => $this->course]);
    }
}
