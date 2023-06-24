<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreateNotification extends Notification
{
    use Queueable;
    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $addr = $this->order->billingAddress;
        return (new MailMessage)
                    ->greeting("Hi {$notifiable->name}")
                    ->line("This Order Created By {$addr->name}")
                    ->line("New Order # {$this->order->number}")
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable){
        $addr = $this->order->billingAddress;

        return [
            'body'=> ("New Order # {$this->order->number}Created By {$addr->name}"),
            'icon'=>'fas fa-envelope',
            'url'=>url('/dashboard'),
            'order_id'=>$this->order->id

        ];
    }

    public function toBroadcast($notifiable)
    {
        $addr = $this->order->billingAddress;
        return [
            'body' => ("New Order # {$this->order->number}Created By {$addr->name}"),
            'icon' => 'fas fa-envelope',
            'url' => url('/dashboard'),
            'order_id' => $this->order->id


        ];
    }




    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
