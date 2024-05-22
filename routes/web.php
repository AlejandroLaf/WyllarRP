<?php

use App\Http\Controllers\CampañaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonajesController;
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
Route::get('/dashboard', [HomeController::class, 'authenticated']);


Route::get('/campaña', [CampañaController::class, 'index'])->name('campañas.index');
Route::post('/campaña', [CampañaController::class, 'store'])->name('campañas.store');
Route::post('/unirse-campaña', [CampañaController::class, 'unirse'])->name('campañas.unirse');
Route::get('/campaña/{id}', [CampañaController::class, 'show'])->name('campaña.mostrar');

Route::get('/personajes', [PersonajesController::class, 'index'])->name('personajes.index');
Route::get('/personajes/create-step1', [PersonajesController::class, 'createStep1'])->name('personajes.create');
Route::post('/personajes/storeStep1', [PersonajesController::class, 'storeStep1'])->name('personajes.storeStep1');
Route::get('/personajes/create-step2', [PersonajesController::class, 'createStep2'])->name('personajes.createStep2');
Route::post('/personajes/store-step2', [PersonajesController::class, 'storeStep2'])->name('personajes.storeStep2');
Route::get('/personajes/create-step3', [PersonajesController::class, 'createStep3'])->name('personajes.createStep3');
Route::post('/personajes/store-step3', [PersonajesController::class, 'storeStep3'])->name('personajes.storeStep3');
Route::get('/personajes/create-step4', [PersonajesController::class, 'createStep4'])->name('personajes.createStep4');
Route::post('/personajes/store-step4', [PersonajesController::class, 'storeStep4'])->name('personajes.storeStep4');
Route::get('/personajes/create-stepMagia', [PersonajesController::class, 'createStepMagia'])->name('personajes.createStepMagia');
Route::post('/personajes/store-stepMagia', [PersonajesController::class, 'storeStepMagia'])->name('personajes.storeStepMagia');
Route::get('/personajes/create-final', [PersonajesController::class, 'createFinal'])->name('personajes.createFinal');
Route::post('/personajes/store-final', [PersonajesController::class, 'storeFinal'])->name('personajes.storeFinal');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});
