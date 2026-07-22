<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // New Routes
    Route::get('/home', function () {
        return view('home.index');
    })->name('home');

    Route::get('/history', function () {
        return view('transactions.index');
    })->name('history');

    Route::get('/transactions/create', function () {
        return view('transactions.create');
    })->name('transactions.create');

    Route::get('/transactions/edit', function () {
        return view('transactions.edit');
    })->name('transactions.edit');

    Route::get('/reports', function () {
        return view('reports.index');
    })->name('reports');

    Route::get('/profil', function () {
        return view('profile.index');
    })->name('profile');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
