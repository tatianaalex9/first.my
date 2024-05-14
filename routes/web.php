<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\MessageController;
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

// ----------------------------------------
Route::prefix('dashboard')->group(function () {

    // Dashboard homepage
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // Dashboard photo resource
    // Route::resource('photos', PhotoController::class);
    Route::resource('messages', MessageController::class);

    // Route::get('/inbox', [MessageController::class, 'inbox'])->name('inbox');
    Route::get('/outbox', [MessageController::class, 'outbox'])->name('outbox');
    

})->middleware(['auth', 'verified'])->name('dashboard');//предотвращает доступ неаутентифицированных пользователей
// ----------------------------------------

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('/photos', PhotoController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
