<?php

use App\View\MapView;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\RgeocodePanel;

Route::get('/', function () { return view('welcome');});

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/elevation', [MapView::class, 'Render'])->name('elevation');

Route::get('/rgeocode', [MapView::class, 'Render'])->name('rgeocode');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';
