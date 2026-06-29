<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Borrow;

class BorrowingService
{
        public function borrow(array $data)
    {
        $book = Book::findOrFail($data['book_id']);

        if ($book->stok <= 0) {
            throw new \Exception('Stok buku habis.');
        }

        $book->decrement('stok');

        // Borrow::create($data);
        Borrow::create([
            'tanggal_peminjaman' => now(),
            'tanggal_pengembalian' => now()->addDays(7),
            'user_id' => auth()->user()->id,
            'book_id' => $book->id,
            'status' => 'dipinjam',
        ]);
    }

    public function returnBook($id)
    {
        $pinjam = Borrow::findOrFail($id);
        $pinjam->buku->increment('stok');
        $pinjam->update([
            'status' => 'dikembalikan',
        ]);
    }
}