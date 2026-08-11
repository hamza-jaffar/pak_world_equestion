<?php

use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\NewLetterAdminController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\NewLetterController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/about-us', 'about-us')->name('aboutus');
Route::view('/portfolio', 'portfolio')->name('portfolio');
Route::view('/contact', 'contact')->name('contact');
Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::post('/newsletter', [NewLetterController::class, 'store'])->name('newsletter');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('dashboard/pages', [AdminPageController::class, 'index'])->name('dashboard.pages');
    Route::get('dashboard/pages/create', [AdminPageController::class, 'create'])->name('dashboard.pages.create');
    Route::post('dashboard/pages', [AdminPageController::class, 'store'])->name('dashboard.pages.store');
    Route::get('dashboard/pages/{page}/edit', [AdminPageController::class, 'edit'])->name('dashboard.pages.edit');
    Route::put('dashboard/pages/{page}', [AdminPageController::class, 'update'])->name('dashboard.pages.update');
    Route::delete('dashboard/pages/{page}', [AdminPageController::class, 'destroy'])->name('dashboard.pages.destroy');
    Route::post('dashboard/pages/upload-image', [AdminPageController::class, 'uploadImage'])->name('dashboard.pages.upload-image');

    Route::get('dashboard/settings', [SiteSettingsController::class, 'index'])->name('dashboard.settings');
    Route::post('dashboard/settings', [SiteSettingsController::class, 'store'])->name('dashboard.settings.store');

    Route::get('dashboard/contacts', [ContactAdminController::class, 'index'])->name('dashboard.contacts');
    Route::delete('dashboard/contacts/{contact}', [ContactAdminController::class, 'destroy'])->name('dashboard.contacts.destroy');
    Route::get('dashboard/newsletters', [NewLetterAdminController::class, 'index'])->name('dashboard.newsletters');
    Route::delete('dashboard/newsletters/{newLetter}', [NewLetterAdminController::class, 'destroy'])->name('dashboard.newsletters.destroy');

    Route::get('dashboard/slider', [SliderController::class, 'index'])->name('dashboard.slider');
    Route::post('dashboard/slider/store', [SliderController::class, 'store'])->name('dashboard.slider.store');
    Route::delete('dashboard/slider/delete/{slider}', [SliderController::class, 'delete'])->name('dashboard.slider.destroy');
});

require __DIR__.'/settings.php';

Route::get('/{slug}', [FrontendPageController::class, 'page'])->name('slugpage');
