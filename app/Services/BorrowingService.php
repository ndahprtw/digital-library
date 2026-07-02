<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

use App\Models\Book;
use App\Models\Borrow;

use Illuminate\Support\Facades\Mail;
use App\Mail\BorrowSuccessMail;
class BorrowingService
{
    public function borrow(array $data)
    {
        // DB::transaction memastikan antara tambah data dan kurang stok berhubungan, salah satu gagal maka gagal semua
        DB::transaction(function () use ($data) {
            $book = Book::findOrFail($data['book_id']);

            if ($book->stok <= 0) {
                throw new \Exception('Stok buku habis.');
            }

            $book->decrement('stok');

            // Borrow::create($data);
            $borrow = Borrow::create([
                'tanggal_peminjaman' => now(),
                'tanggal_pengembalian' => now()->addDays(7),
                'user_id' => auth()->user()->id,
                'book_id' => $book->id,
                'status' => 'dipinjam',
            ]);

            $this->sendBorrowSuccessEmail($borrow);
            return $borrow;
        });
    }

    public function returnBook($id)
    {
        $pinjam = Borrow::findOrFail($id);
        $pinjam->buku->increment('stok');
        $pinjam->update([
            'status' => 'dikembalikan',
        ]);
    }

    public function sendBorrowSuccessEmail(Borrow $borrow): void
    {
        Mail::to($borrow->user->email)->send(new BorrowSuccessMail($borrow));
        
    }
}