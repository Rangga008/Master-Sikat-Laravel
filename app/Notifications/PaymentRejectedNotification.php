<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentRejectedNotification extends Notification
{
    use Queueable;
    public $order;
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Pembayaran Ditolak - Pesanan #' . $this->order->id)
            ->line('Pembayaran untuk pesanan Anda telah ditolak.')
            ->line('Alasan: ' . $this->order->rejection_notes ?? 'Tidak ada alasan spesifik')
            ->line('Pesanan Anda secara otomatis dibatalkan.')
            ->action('Lihat Detail Pesanan', route('orders.show', $this->order));
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