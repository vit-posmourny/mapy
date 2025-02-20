<?php

use App\Http\Controllers\CroppieController;
use App\View\MapView;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () { return view('welcome');})->name('welcome');

Route::get('/croppie', [CroppieController::class, 'showCroppieDialog'])->name('croppie.show');
Route::post('/croppie', [CroppieController::class, 'uploadAccountImg'])->name('croppie.upload');

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/elevation', [MapView::class, 'Render'])->name('elevation');

Route::get('/rgeocode', [MapView::class, 'Render'])->name('rgeocode');

Route::get('/geocode', [MapView::class, 'Render'])->name('geocode');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
