<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Landing\Home;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Landing\Services\Index as ServicesIndex;
use App\Livewire\Landing\Services\Detail as ServiceDetail;
use App\Livewire\Landing\Products\Index as ProductsIndex;
use App\Livewire\Landing\Products\Detail as ProductDetail;
use App\Livewire\Landing\Doctors\Index as DoctorsIndex;
use App\Livewire\Landing\Testimonials\Index as TestimonialsIndex;
use App\Livewire\Landing\Testimonials\Detail as TestimonialsDetail;
use App\Livewire\Landing\Promos\Index as PromosIndex;

use App\Livewire\Admin\Services\Index as ServicesAdminIndex;
use App\Livewire\Admin\Products\Index as ProductsAdminIndex;
use App\Livewire\Admin\Promos\Index as PromosAdminIndex;


// Route::view('/', 'welcome');
Route::get('/', Home::class)->name('home');
// ===== SERVICES GUEST ROUTE =====
Route::get('/layanan', ServicesIndex::class)->name('services');
Route::get('/layanan/{slug}', ServiceDetail::class)->name('services.detail');

// ===== PRODUCTS GUEST ROUTE =====
Route::get('/produk', ProductsIndex::class)->name('products');
Route::get('/produk/{slug}', ProductDetail::class)->name('products.detail');

// ===== DOCTORS GUEST ROUTE =====
Route::get('/dokter', DoctorsIndex::class)->name('doctors');

// ===== TESTIMONIALS GUEST ROUTE =====
Route::get('/testimoni', TestimonialsIndex::class)->name('testimonials');
Route::get('/testimoni/{slug}', TestimonialsDetail::class)->name('testimonials.detail');

// ===== PROMOS GUEST ROUTE =====
Route::get('/promo', PromosIndex::class)->name('promos');


// ===== ADMIN ROUTE (BACKEND) =====
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        // nanti route CRUD tiap modul ditambahkan di sini
        Route::get('/services', ServicesAdminIndex::class)->name('services.index');
        Route::get('/products', ProductsAdminIndex::class)->name('products.index');
        Route::get('/promos', PromosAdminIndex::class)->name('promos.index');
});

Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

require __DIR__.'/auth.php';
