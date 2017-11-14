<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\CourseUser as User;
use App\Models\Course;

class CourseNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Models\CourseUser
     */
    protected $user;

    /**
     * @var \App\Models\Course
     */
    protected $course;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Course $course)
    {
        $this->user = $user;
        $this->course = $course;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('dont-reply@unisaonline.net')
            ->markdown('emails.courses.notifications.notify');
    }
}
