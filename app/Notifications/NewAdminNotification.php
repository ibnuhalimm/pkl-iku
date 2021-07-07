<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAdminNotification extends Notification
{
    use Queueable;

    private $user;
    private $plainPassword;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $plainPassword)
    {
        $this->user = $user;
        $this->plainPassword = $plainPassword;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $appName = config('app.name');

        return (new MailMessage)
                    ->subject("Anda Menjadi Admin")
                    ->greeting("Hai {$this->user->name}.")
                    ->line("Anda telah ditambahkan sebagai Admin di {$appName}. Silahkan gunakan data berikut untuk login:")
                    ->line("- Username : {$this->user->username}")
                    ->line("- Password : {$this->plainPassword}")
                    ->action('Login Di sini', url('/'))
                    ->line('Terima kasih.');
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
