<?php

use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\NewLetterAdminController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\NewLetterController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/about-us', 'about-us')->name('aboutus');
Route::view('/portfolio', 'portfolio')->name('portfolio');
Route::view('/contact', 'contact')->name('contact');
Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::post('/newsletter', [NewLetterController::class, 'store'])->name('newsletter');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('dashboard/pages', [PageController::class, 'index'])->name('dashboard.pages');
    Route::get('dashboard/pages/create', [PageController::class, 'create'])->name('dashboard.pages.create');
    Route::post('dashboard/pages', [PageController::class, 'store'])->name('dashboard.pages.store');
    Route::get('dashboard/pages/{page}/edit', [PageController::class, 'edit'])->name('dashboard.pages.edit');
    Route::put('dashboard/pages/{page}', [PageController::class, 'update'])->name('dashboard.pages.update');
    Route::delete('dashboard/pages/{page}', [PageController::class, 'destroy'])->name('dashboard.pages.destroy');
    Route::post('dashboard/pages/upload-image', [PageController::class, 'uploadImage'])->name('dashboard.pages.upload-image');

    Route::get('dashboard/contacts', [ContactAdminController::class, 'index'])->name('dashboard.contacts');
    Route::delete('dashboard/contacts/{contact}', [ContactAdminController::class, 'destroy'])->name('dashboard.contacts.destroy');
    Route::get('dashboard/newsletters', [NewLetterAdminController::class, 'index'])->name('dashboard.newsletters');
    Route::delete('dashboard/newsletters/{newLetter}', [NewLetterAdminController::class, 'destroy'])->name('dashboard.newsletters.destroy');
});

require __DIR__.'/settings.php';
