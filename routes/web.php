<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    
    Route::resource('pinjam', BorrowController::class);

    Route::resource('buku', BookController::class);
    Route::resource('user', UserController::class);
    Route::resource('kategori', CategoryController::class);

});

Route::get('/403', function () {
    return view('pages.noted.403');
});
Route::get('/404', function () {
    return view('pages.noted.404');
});

require __DIR__.'/auth.php';
