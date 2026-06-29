<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index() {
        $data = Borrow::with(['buku.category', 'user'])->paginate(10);
        return view('pages.pinjam.index', compact('data'));
    }

    public function store(Request $request)
    {
        $book = Book::findOrFail($request->book_id);

        if ($book->stok <= 0) {
            return back()->with('error', 'Stok habis');
        }

        $book->decrement('stok');

        Borrow::create([
            'tanggal_peminjaman' => now(),
            'tanggal_pengembalian' => now()->addDays(7),
            'user_id' => auth()->user()->id,
            'book_id' => $request->book_id,
            'status' => 'dipinjam',
        ]);

        return redirect()->route('pinjam.index')->with('success', 'Buku Sukses Dipinjam.');;
    }

    public function update(Request $request, $id)
    {   
        $pinjam = Borrow::findOrFail($id);
        $pinjam->update([
            'status' => 'dikembalikan',
        ]);

        $book = Book::findOrFail($request->book_id);
        $book->increment('stok');

        return redirect()->route('pinjam.index')->with('success', 'Buku Sukses Dikembalikan.');;
    }
}
