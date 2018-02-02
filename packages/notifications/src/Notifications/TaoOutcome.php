<?php

namespace EONConsulting\Notifications\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class TaoOutcome extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Tao Result
     *
     * @var message
     */
    protected $tao_result;

    /**
     * Provide the views that should be used.
     *
     * @var array
     */
    protected $views = [
        'email' => 'eon.notifications::email.tao-outcome',
        'database' => 'eon.notifications::database.tao-outcome'
    ];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tao_result)
    {
        $this->tao_result = $tao_result;
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
            ->subject('Tao Assessment Result')
            ->markdown($this->views['email'], [
                'user' => $notifiable,
                'tao_result' => $this->tao_result
            ]);
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable) // @TODO add the text for a sms message
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
            'user' => $notifiable,
            'tao_result' => $this->tao_result
        ])->render();

        return [
            'subject' => 'Tao Assessment Result',
            'message' => $data,
        ];
    }

}