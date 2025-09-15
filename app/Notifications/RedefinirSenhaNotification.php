<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RedefinirSenhaNotification extends Notification
{
    use Queueable;
    public $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        $url = 'http://localhost:8000/reset/password/'. $this->token;
        $minutos = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
         return (new MailMessage)
            ->subject('Atualização de Senha')
            ->line('Voce esta recebendo esse email por que recebemos uma tentativa de recuperação de senha.')
            ->action('Mudar a senha', $url)
            ->line('O link acima expira em: '.$minutos.' minutos')
            ->line('Caso nao tenha requisitado, nao faça nada');

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
