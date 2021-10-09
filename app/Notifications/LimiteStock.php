<?php

namespace App\Notifications;

use App\Models\Bodega;
use App\Models\Producto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LimiteStock extends Notification
{
    use Queueable;

    public $producto;
    public $bodega;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Producto $producto, Bodega $bodega)
    {
        $this->producto = $producto;
        $this->bodega = $bodega;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            "producto" => $this->producto,
            "bodega" => $this->bodega,
            "admin" => $notifiable
        ];
    }
}


//Notificación
// $admins = User::where("role_id", 1)->get();
// Notification::send($admins, new LimiteStock($producto, $bodega));