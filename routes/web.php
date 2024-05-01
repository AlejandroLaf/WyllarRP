<?php

use App\Http\Controllers\CampañaController;
use App\Http\Controllers\HomeController;
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


Route::get('/', HomeController::class)->name('home');


Route::get('/campaña', [CampañaController::class, 'index'])->name('campañas.index');
Route::post('/campaña', [CampañaController::class, 'store'])->name('campañas.store');
Route::post('/unirse-campaña', [CampañaController::class, 'unirse'])->name('campañas.unirse');
Route::get('/campaña/{id}', [CampañaController::class, 'show'])->name('campaña.mostrar');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});
