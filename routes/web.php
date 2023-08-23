<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManagementController;
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

Route::get('/', function () {
    return view('welcome');
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

Route::prefix('admin')->group(function (){
    Route::get('/', [ManagementController::class, 'top'])->name('manage.top');
    Route::prefix('bio')->group(function (){
        Route::get('/', [ManagementController::class, 'bio_top'])->name('manage.bio');
        Route::post('/edit_delete', [ManagementController::class, 'bio_edit_delete'])->name('manage.bio.edit_delete');
        Route::post('/save', [ManagementController::class, 'bio_save'])->name('manage.bio.save');
    });
})->middleware("auth");