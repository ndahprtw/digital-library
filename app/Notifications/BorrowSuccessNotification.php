<?php

namespace App\Notifications;

use App\Models\Borrow;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BorrowSuccessNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Borrow $borrow
    )
    {}

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
            ->subject('Peminjaman Buku Berhasil')
            ->greeting('Halo '.$notifiable->name)
            ->line('Peminjaman buku berhasil dilakukan.')
            ->line('Judul Buku : '.$this->borrow->buku->judul)
            ->line('Tanggal Pinjam : '.$this->borrow->tanggal_pinjam)
            ->action('Lihat Peminjaman', url('/borrow'))
            ->line('Terima kasih.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'judul' => $this->borrow->buku->judul,
            'pesan' => 'Peminjaman buku berhasil.',
            'borrow_id' => $this->borrow->id,
            'url' => route('pinjam.index'),
        ];
    }
}
