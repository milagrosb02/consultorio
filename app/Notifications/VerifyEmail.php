<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends Notification
{
    protected $user;
    protected $frontendUrl;

    public function __construct($user, $frontendUrl)
    {
        $this->user = $user;
        $this->frontendUrl = $frontendUrl;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $verificationUrl = $this->frontendUrl . '/email/verify/' . $notifiable->id . '/' . $notifiable->email_verification_token;

        return (new MailMessage)
            ->greeting('¡Hola ' . $this->user->name . '!')
            ->line('Gracias por registrarte en nuestro consultorio.')
            ->action('Verificar Email', $verificationUrl)
            ->line('Si no creaste una cuenta en nuestro consultorio, puedes ignorar este mensaje.')
            ->salutation('¡Que tengas un excelente día!')
            ->with(['frontendUrl' => $this->frontendUrl]); // Agregar la variable frontendUrl al correo
    }

    protected function verificationUrl($notifiable)
    {
        return $this->frontendUrl . '/email/verify/' . $notifiable->id . '/' . $notifiable->email_verification_token;
    }
}
