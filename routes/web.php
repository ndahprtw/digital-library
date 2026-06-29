<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware('auth')->group(function () {

    // Buku
    // Route::get('/buku', [BookController::class, 'index'])->name('buku.index');
    // Route::get('/buku/{buku}', [BookController::class, 'show'])->name('buku.show');

    // Kategori
    // Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori.index');
    Route::resource('pinjam', BorrowController::class);

    Route::middleware('role:admin')->group(function () {

        Route::resource('buku', BookController::class);

        Route::resource('kategori', CategoryController::class)
            ->except(['index']);

    });

});

Route::get('/403', function () {
    return view('pages.noted.403');
});
Route::get('/404', function () {
    return view('pages.noted.404');
});

require __DIR__.'/auth.php';
