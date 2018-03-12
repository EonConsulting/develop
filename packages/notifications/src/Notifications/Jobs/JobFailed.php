<?php

namespace EONConsulting\Notifications\Notifications\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class JobFailed extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var message
     */
    protected $message;

    /**
     * Provide the views that should be used.
     *
     * @var array
     */
    protected $views = [
        'email' => 'eon.notifications::email.job-failed',
        'database' => 'eon.notifications::database.job-failed'
    ];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
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
        return ['mail','database'];
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
            ->subject($this->message['title'])
            ->markdown($this->views['email'], [
                'message' => $this->message
            ]);
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
            'message' => $this->message
        ])->render();

        return [
            'subject' => $this->message['title'],
            'message' => $data,
        ];
    }

}