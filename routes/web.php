<?php

use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\NewLetterAdminController;
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
    Route::get('dashboard/contacts', [ContactAdminController::class, 'index'])->name('dashboard.contacts');
    Route::delete('dashboard/contacts/{contact}', [ContactAdminController::class, 'destroy'])->name('dashboard.contacts.destroy');
    Route::get('dashboard/newsletters', [NewLetterAdminController::class, 'index'])->name('dashboard.newsletters');
    Route::delete('dashboard/newsletters/{newLetter}', [NewLetterAdminController::class, 'destroy'])->name('dashboard.newsletters.destroy');
});

require __DIR__.'/settings.php';
