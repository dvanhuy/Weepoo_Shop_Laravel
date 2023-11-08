<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    use Queueable;
    protected $token;
    protected $email;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token = null,$email = null)
    {
        if ($token !== null) {
            $this->token = $token;
        }
        if ($email !== null) {
            $this->email = $email;
        }
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

    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('Yêu cầu đặt lại mật khẩu')
            ->line('Bạn nhận được email này vì một yêu cầu đặt lại mqật khẩu đã được gửi tới tài khoản của bạn.')
            ->action('Đặt lại mật khẩu', url($url))
            ->line('Nếu bạn không thực hiện yêu cầu này, bạn có thể bỏ qua email này.')
            ->salutation('Trân trọng, ' . config('app.name'));
    }
    
    public function toMail()
    {
        $url = url('/forgot-password/password/reset/?token=' . $this->token.'&email='. $this->email);
        return $this->buildMailMessage($url);
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
