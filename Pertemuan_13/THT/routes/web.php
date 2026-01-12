<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('tickets.index');
    }
    return view('auth.login'); 
});

Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', function () {
        return redirect()->route('tickets.index');
    })->name('dashboard');

    Route::resource('tickets', TicketController::class)->except(['edit', 'update', 'destroy']);
    
    Route::post('/tickets/{ticket}/comments', [CommentController::class, 'store'])
        ->name('tickets.comments.store');

    Route::middleware('admin')->group(function () {
        Route::patch('/tickets/{ticket}/status', [TicketController::class, 'update'])
            ->name('tickets.update.status');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';