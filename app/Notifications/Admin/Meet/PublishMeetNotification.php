<?php

namespace App\Notifications\Admin\Meet;

use App\Notifications\Channels\SMSChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class PublishMeetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private array $meet;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($meet)
    {
        //
        $this->meet = $meet;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail', SMSChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Meet : '.$this->meet['title'])
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toSMS($notifiable)
    {
        Log::info('SMS Publish Meet : '.$this->meet['title'].' To : '.$notifiable->mobile);
    }

    public function toArray($notifiable)
    {
        return [
            'status' => 'published',
            'id' => $this->meet['id'],
            'title' => $this->meet['title'],
        ];
    }
}
