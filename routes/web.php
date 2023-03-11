<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('tickets', TicketController::class)->middleware(['auth']);

Route::get('/liste', '\App\Http\Controllers\TicketController@list')->name('tickets.list');
Route::get('/mes-taches', '\App\Http\Controllers\TicketController@tasks')->name('tickets.tasks');
Route::post('/tickets/{ticket}/assign', '\App\Http\Controllers\TicketController@assign')->name('tickets.assign');
Route::post('/tickets/{ticket}/etat', '\App\Http\Controllers\TicketController@progress')->name('tickets.state');

Route::resource('users', UserController::class)->middleware(['auth', 'admin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
