<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCancelledNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail']; // Anda bisa menambahkan channel lain seperti database, SMS, dll.
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Pesanan Dibatalkan - Pesanan #' . $this->order->id)
            ->line('Pesanan Anda dengan ID #' . $this->order->id . ' telah dibatalkan.')
            ->line('Alasan: ' . ($this->order->rejection_notes ?? 'Tidak ada alasan spesifik.'))
            ->action('Lihat Detail Pesanan', url('/orders/' . $this->order->id))
            ->line('Terima kasih telah berbelanja dengan kami!');
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'message' => 'Pesanan Anda telah dibatalkan.',
            'rejection_notes' => $this->order->rejection_notes,
        ];
    }
}