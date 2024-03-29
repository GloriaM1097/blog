<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Egresado;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RepliedToThread extends Notification
{
    use Queueable;

    public $thread;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($thread)
    {
        //
        $this->thread = $thread; 
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database','broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return[
            'thread'=>$this->thread,
            'egresado'=>$this->thread->egresado,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'thread'=>$this->thread,
            'egresado'=>$this->thread->egresado,
        ]); 
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
