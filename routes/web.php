<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Landing\Home;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Landing\Services\Index as ServicesIndex;
use App\Livewire\Landing\Services\Detail as ServiceDetail;

// Route::view('/', 'welcome');
Route::get('/', Home::class)->name('home');
Route::get('/layanan', ServicesIndex::class)->name('services');
Route::get('/layanan/{slug}', ServiceDetail::class)->name('services.detail');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        // nanti route CRUD tiap modul ditambahkan di sini
});

Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

require __DIR__.'/auth.php';
