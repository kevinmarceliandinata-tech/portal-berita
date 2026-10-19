<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\UserController;

// ===== Frontend (publik) =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita/{berita}', [HomeController::class, 'show'])->name('berita.show');
Route::get('/kategori/{kategori}', [HomeController::class, 'kategori'])->name('kategori.show');
Route::get('/agenda', [HomeController::class, 'agenda'])->name('agenda.index');
Route::get('/pengumuman', [HomeController::class, 'pengumuman'])->name('pengumuman.index');
Route::get('/pengumuman/{pengumuman}', [HomeController::class, 'pengumumanShow'])->name('pengumuman.show');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri.index');
Route::get('/galeri/{album}', [HomeController::class, 'galeriShow'])->name('galeri.show');

// ===== Autentikasi =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ===== Area login: admin & user =====
Route::middleware('auth')->prefix('dashboard')->group(function () {

    // Dashboard menyesuaikan level
    Route::get('/', DashboardController::class)->name('dashboard');

    // Berita: admin kelola semua, user hanya milik sendiri (dicek di controller)
    Route::resource('berita', BeritaController::class)
        ->parameters(['berita' => 'berita'])
        ->except('show');

        // ===== Khusus ADMIN =====
    Route::middleware('role:admin')->group(function () {
        Route::resource('kategori', KategoriController::class)
            ->only(['index', 'store', 'destroy']);

        Route::resource('agendas', AgendaController::class)
            ->parameters(['agendas' => 'agenda'])
            ->except('show');

        Route::resource('pengumumans', PengumumanController::class)
            ->parameters(['pengumumans' => 'pengumuman'])
            ->except('show');

        Route::resource('albums', AlbumController::class)
            ->parameters(['albums' => 'album'])
            ->except('show');

        Route::resource('galeries', GaleryController::class)
            ->parameters(['galeries' => 'galery'])
            ->except('show');

        Route::resource('users', UserController::class)
            ->parameters(['users' => 'user'])
            ->except('show');
    });
});