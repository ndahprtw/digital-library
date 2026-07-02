<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BorrowReminderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $borrow;

    public function __construct($borrow)
    {
        $this->borrow = $borrow;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [
            'mail',
            'database',
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Reminder Pengembalian Buku')
            ->greeting('Halo '.$notifiable->name)
            ->line('Besok adalah batas pengembalian buku.')
            ->line('Judul : '.$this->borrow->buku->judul)
            ->action('Lihat Peminjaman', url('/borrow'))
            ->line('Mohon segera dikembalikan.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'judul'=>$this->borrow->buku->judul,
            'pesan'=>'Besok batas pengembalian buku.',
            'url'=>route('pinjam.index'),
        ];
    }
}
