<?php

use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\NewLetterAdminController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewLetterController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', function () {
    $aboutUs = \App\Models\AboutUs::latest()->first();
    return view('about-us', compact('aboutUs'));
})->name('aboutus');
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

    Route::get('dashboard/about-us', [AboutUsController::class, 'index'])->name('dashboard.about-us.index');
    Route::get('dashboard/about-us/create', [AboutUsController::class, 'create'])->name('dashboard.about-us.create');
    Route::post('dashboard/about-us', [AboutUsController::class, 'store'])->name('dashboard.about-us.store');
    Route::get('dashboard/about-us/{aboutUs}/edit', [AboutUsController::class, 'edit'])->name('dashboard.about-us.edit');
    Route::put('dashboard/about-us/{aboutUs}', [AboutUsController::class, 'update'])->name('dashboard.about-us.update');
    Route::delete('dashboard/about-us/{aboutUs}', [AboutUsController::class, 'destroy'])->name('dashboard.about-us.destroy');
});

require __DIR__.'/settings.php';

Route::get('/{slug}', [FrontendPageController::class, 'page'])->name('slugpage');
