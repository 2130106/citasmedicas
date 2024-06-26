<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitaController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/vista-doctor', function () {
    return view('auth.home');
})->name('auth.home');

Route::get('/vista-secretaria', function () {
    return view('citas.index');
})->name('citas.index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth')->group(function () {
    Route::get('/home', [AuthController::class, 'home'])->name('home');
    Route::post('/logout', function() {
        Auth::logout();
        return redirect('/login');
    })->name('logout');

    // Rutas para gestionar citas
    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
    Route::get('/citas/create', [CitaController::class, 'create'])->name('citas.create');
    Route::post('/citas/store', [CitaController::class, 'store'])->name('citas.store');
    Route::delete('/citas/destroy/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');

    // Rutas para gestionar pacientes
    Route::get('/pacientes', [AuthController::class, 'showPacientes'])->name('pacientes.index');
    Route::post('/pacientes', [AuthController::class, 'storePaciente'])->name('pacientes.store');
    Route::delete('/pacientes/{id}', [AuthController::class, 'destroyPaciente'])->name('pacientes.destroy');

    
});
