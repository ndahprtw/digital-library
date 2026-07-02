<?php

namespace App\Console\Commands;

use App\Models\Borrow;
use Illuminate\Console\Command;
use App\Notifications\BorrowReminderNotification;


class SendBorrowReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-borrow-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $borrows = Borrow::whereDate('tanggal_pengembalian',now()->addDay()->toDateString())
            ->where('status', 'dipinjam')
            ->get();

        foreach ($borrows as $borrow) {
            $borrow->user->notify(
                new BorrowReminderNotification($borrow)
            );
        }

        $this->info('Reminder berhasil dikirim.');
        return self::SUCCESS;
    }
}
