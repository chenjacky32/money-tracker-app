<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return view('home.index');
});

Route::get('/history', function () {
    return view('transactions.index');
});

Route::get('/transactions/create', function () {
    return view('transactions.create');
});

Route::get('/transactions/edit', function () {
    return view('transactions.edit');
});

Route::get('/reports', function () {
    return view('reports.index');
});

Route::get('/profil', function () {
    return view('profile.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
