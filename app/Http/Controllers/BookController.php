<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BookController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view books', only: ['index', 'show']),
            new Middleware('permission:create books', only: ['create', 'store']),
            new Middleware('permission:edit books', only: ['edit', 'update']),
            new Middleware('permission:delete books', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Book::query()
        ->with('category')
        ->when($request->search, function ($query) use ($request) {
            $query->where('judul', 'like', "%{$request->search}%");
        })
        ->orderBy('judul')
        ->paginate(5);

        return view('pages.books.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Category::orderBy('nama_kategori')->get();
        return view('pages.books.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        Book::create($request->validated());
    
        return redirect()->route('buku.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $buku)
    {
        $kategori = Category::orderBy('nama_kategori')->get();
        return view('pages.books.edit', compact('buku', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $buku)
    {
        $buku->update($request->validated());
    
        return redirect()->route('buku.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $buku)
    {
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Data berhasil dihapus.');
    }

    public function exportPdf()
    {
        $data = Book::with('category')->get();

        // return view('pages.books.download', compact('data'));
        $pdf = Pdf::loadView('pages.books.download', compact('data'))
            ->setPaper('a4', 'portrait'); //untuk set uk ukuran kertas dan orientasi


        // // jika ingin langsung mendownload file PDF
        // return $pdf->download('laporan-buku.pdf');

        // jika ingin menampilkan preview PDF
        return $pdf->stream('laporan.pdf');
    }
}