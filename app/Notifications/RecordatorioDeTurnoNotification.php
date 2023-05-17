<?php

namespace App\Notifications;

use App\Models\Turno;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RecordatorioDeTurnoNotification extends Notification
{
    use Queueable;

    public $turno;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Turno $turno)
    {
        $this->turno = $turno;
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
        return (new MailMessage)
                    ->subject('Recordatorio de turno.')
                    ->line('Recordatorio de turno.')
                    ->line('Usted esta recibiendo este email como recordatorio de su turno.')
                    ->line('con la Profesional ' . $this->turno->user->first_name . ' ' . $this->turno->user->last_name)
                    ->line('el dia de ' . $this->turno->fecha . ' a las ' . $this->turno->hora)
                    ->line('¡Gracias por su confianza!');
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
