<?php

namespace EONConsulting\Notifications\Notifications\Courses;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use EONConsulting\Storyline2\Models\Course;

class CourseNotifier extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Types of notifications to be sent
     *
     * @var notification_types
     */
    protected $notification_types;

    /**
     * Custom message entered by user
     *
     * @var message
     */
    protected $message;

    /**
     * @var \App\Models\Course
     */
    protected $course;

    /**
     * Provide the views that should be used.
     *
     * @var array
     */
    protected $views = [
        'email' => 'eon.notifications::email.courses.notify',
        'database' => 'eon.notifications::database.courses.notify'
    ];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Course $course, $notification_types, $message)
    {
        $this->course = $course;
        $this->notification_types = $notification_types;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->notification_types;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('dont-reply@unisaonline.net', 'Unisa Online')
            ->subject('Course Notification')
            ->markdown($this->views['email'], [
                'course' => $this->course,
                'user' => $notifiable,
                'message' => $this->message
            ]);
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content('Your SMS message content!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $data = view()->first([
            $this->views['database'], $this->views['email']
        ], [
            'course' => $this->course,
            'user' => $notifiable,
            'message' => $this->message
        ])->render();

        return [
            'subject' => 'Course Notification',
            'message' => $data,
        ];
    }

}