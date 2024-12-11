<?php

use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ProfileController;
use App\Livewire\SidePanel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/elevation', [PlaceController::class, 'index'])->middleware(['auth', 'verified'])->name('elevation.index');
//Route::post('/elevation/store', [PlaceController::class, 'store'])->middleware(['auth', 'verified'])->name('elevation.store');
Route::get('/elevation', SidePanel::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';
