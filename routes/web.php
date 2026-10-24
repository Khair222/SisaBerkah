<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AiScannerController;
use App\Http\Controllers\ChatbotController;

// Public Web Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jenis-limbah', [HomeController::class, 'jenisLimbah'])->name('jenis-limbah');
Route::get('/ai-scanner', [AiScannerController::class, 'index'])->name('ai-scanner');
Route::post('/ai-scanner/analyze', [AiScannerController::class, 'analyze'])->name('ai-scanner.analyze');
Route::post('/api/chatbot/message', [ChatbotController::class, 'sendMessage'])->name('chatbot.message');
Route::post('/chatbot/message', [ChatbotController::class, 'sendMessage']);
Route::get('/mitra', [MitraController::class, 'index'])->name('mitra.index');
Route::get('/mitra-detail/{id}', [MitraController::class, 'detail'])->name('mitra.detail');

// Mitra Dashboard (Khusus Akun Mitra)
Route::get('/kelola-mitra', [MitraController::class, 'dashboard'])->name('mitra.dashboard');
Route::post('/kelola-mitra/update', [MitraController::class, 'update'])->name('mitra.update');
Route::post('/kelola-mitra/password', [MitraController::class, 'updatePassword'])->name('mitra.updatePassword');
Route::post('/kelola-mitra/pasokan', [MitraController::class, 'storePasokan'])->name('mitra.pasokan.store');
Route::post('/kelola-mitra/pasokan/{id}/update', [MitraController::class, 'updatePasokan'])->name('mitra.pasokan.update');
Route::post('/kelola-mitra/pasokan/{id}/delete', [MitraController::class, 'deletePasokan'])->name('mitra.pasokan.delete');

// Profil Pengguna Biasa (Khusus Akun User)
Route::get('/profil-saya', [UserController::class, 'profile'])->name('user.profile');
Route::post('/profil-saya/update', [UserController::class, 'updateProfile'])->name('user.updateProfile');
Route::post('/profil-saya/password', [UserController::class, 'updatePassword'])->name('user.updatePassword');

// Auth (Login, Register, Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');
