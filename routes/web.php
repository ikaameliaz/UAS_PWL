<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BeritaController;
use App\Http\Middleware\CheckRole;
use App\Models\Berita;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Beranda publik
Route::get('/', function () {
    $beritas = Berita::where('status', 'published')->latest()->get();
    return view('home', compact('beritas'));
});

// Auth bawaan Laravel
Auth::routes(['register' => true]);

// Route berita publik (tanpa login)
Route::get('/berita/publik', [BeritaController::class, 'publik'])->name('berita.publik');

// Route EDITOR (Diletakkan SEBELUM resource!)
Route::middleware(['auth', 'checkrole:editor'])->group(function () {
    Route::get('/berita/approval', [BeritaController::class, 'approval'])->name('berita.approval');
    Route::post('/berita/{id}/publish', [BeritaController::class, 'publish'])->name('berita.publish');
});

// Route semua user login
Route::middleware(['auth'])->group(function () {
    Route::resource('berita', BeritaController::class)->parameters([
        'berita' => 'berita'
    ]);
});

// Route ADMIN
Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/dashboard/admin', fn () => view('admin.dashboard'));
});

Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/dashboard/admin', fn () => view('admin.dashboard'));

    // Tambahan: route daftar user
    Route::get('/dashboard/users', [UserController::class, 'index'])->name('users.index');
});


// Debug
Route::get('/debug-role', function () {
    dd(Auth::check(), Auth::user()?->role);
});

// Test langsung approval (opsional)
Route::get('/test-approval', [BeritaController::class, 'approval']);



Route::middleware('auth')->group(function () {
    Route::get('/profil/edit', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::post('/profil/update', [ProfileController::class, 'update'])->name('profil.update');
});


Route::middleware(['auth', 'checkrole:admin'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/update-role', [UserController::class, 'updateRole'])->name('admin.user.updateRole');
});
