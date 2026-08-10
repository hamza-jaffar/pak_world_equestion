<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/about-us', 'about-us')->name('aboutus');
Route::view('/portfolio', "portfolio")->name('portfolio');
Route::view('/contact', 'contact')->name('contact');
Route::post('contact/store', function(Request $request) {dd($request);})->name('contact.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
