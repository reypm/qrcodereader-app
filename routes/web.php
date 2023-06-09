<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/submission', [SubmissionController::class, 'index'])->name('submission.index');
    Route::post('/submission', [SubmissionController::class, 'store'])->name('submission.upload');
    Route::get('/submission/create', [SubmissionController::class, 'create'])->name('submission.create');
    Route::get('/submission/{submission}', [SubmissionController::class, 'show'])->name('submission.show');
    Route::patch('/submission/{submission}', [SubmissionController::class, 'update'])->name('submission.update');
    Route::delete('/submission/{submission}', [SubmissionController::class, 'destroy'])->name('submission.destroy');
});

Route::resource('submission', SubmissionController::class)->middleware('auth');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
