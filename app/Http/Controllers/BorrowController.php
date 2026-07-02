<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\BorrowingService;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class BorrowController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:borrow books', only: ['index', 'store']),
            new Middleware('permission:return books', only: ['create', 'update']),
        ];
    }
    protected BorrowingService $borrowingService;

    public function __construct(BorrowingService $borrowingService)
    {
        $this->borrowingService = $borrowingService;
    }

    public function index() {
        $data = Borrow::with(['buku.category', 'user'])->paginate(10);
        return view('pages.pinjam.index', compact('data'));
    }

    public function store(Request $request)
    {
        $this->borrowingService->borrow($request->all());
        return redirect()->route('pinjam.index')->with('success', 'Buku Sukses Dipinjam.');;
    }

    public function update($id)
    {   
        $this->borrowingService->returnBook($id);
        return redirect()->route('pinjam.index')->with('success', 'Buku Sukses Dikembalikan.');;
    }

    public function read($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return redirect($notification->data['url']);
    }
}
