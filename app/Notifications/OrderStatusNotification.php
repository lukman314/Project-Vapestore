<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Order; // Pastikan ini memanggil model Order milikmu

class OrderStatusNotification extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        // Menyimpan data order yang dikirim dari controller
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // Ubah dari 'mail' menjadi 'database'
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     * Ini adalah data yang akan masuk ke kolom 'data' di tabel notifications
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'status'   => $this->order->status, 
            'message'  => $this->order->admin_notes ?? 'Status pesanan Anda telah diperbarui oleh Admin.',
        ];
    }
}