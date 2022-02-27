<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlaced extends Notification
{
    use Queueable;
    
    public $food_name;
    public $customer_name;
    public $order_reference;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($food_name, $customer_name, $order_reference)
    {
        $this->food_name = $food_name;
        $this->customer_name = $customer_name;
        $this->order_reference = $order_reference;
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
            'info' => 'New Order '.$this->food_name.'!',
            'customer_name' => $this->customer_name,
            'order' => $this->order_reference,
        ];
    }
}
