<?php

use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\NewLetterAdminController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\PortfoliosController;
use App\Http\Controllers\Admin\CertificationsController;
use App\Http\Controllers\Admin\MembersController;
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
Route::get('/portfolio', function () {
    $portfolioItems = \App\Models\Portfolios::latest()->get()->map(fn($p) => [
        'image'    => $p->image,
        'title'    => $p->title,
        'category' => $p->category,
        'label'    => $p->label,
        'url'      => $p->url ?? '#',
    ])->toArray();

    $certifications = \App\Models\Certifications::all()->map(fn($c) => [
        'image' => $c->image,
        'alt'   => $c->alt,
    ])->toArray();

    $members = \App\Models\Members::all()->map(fn($m) => [
        'image' => $m->image,
        'alt'   => $m->alt,
    ])->toArray();

    return view('portfolio', compact('portfolioItems', 'certifications', 'members'));
})->name('portfolio');
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

    Route::get('dashboard/services', [ServicesController::class, 'index'])->name('dashboard.services.index');
    Route::get('dashboard/services/create', [ServicesController::class, 'create'])->name('dashboard.services.create');
    Route::post('dashboard/services', [ServicesController::class, 'store'])->name('dashboard.services.store');
    Route::get('dashboard/services/{service}/edit', [ServicesController::class, 'edit'])->name('dashboard.services.edit');
    Route::put('dashboard/services/{service}', [ServicesController::class, 'update'])->name('dashboard.services.update');
    Route::delete('dashboard/services/{service}', [ServicesController::class, 'destroy'])->name('dashboard.services.destroy');

    Route::get('dashboard/portfolios', [PortfoliosController::class, 'index'])->name('dashboard.portfolios.index');
    Route::get('dashboard/portfolios/create', [PortfoliosController::class, 'create'])->name('dashboard.portfolios.create');
    Route::post('dashboard/portfolios', [PortfoliosController::class, 'store'])->name('dashboard.portfolios.store');
    Route::get('dashboard/portfolios/{portfolio}/edit', [PortfoliosController::class, 'edit'])->name('dashboard.portfolios.edit');
    Route::put('dashboard/portfolios/{portfolio}', [PortfoliosController::class, 'update'])->name('dashboard.portfolios.update');
    Route::delete('dashboard/portfolios/{portfolio}', [PortfoliosController::class, 'destroy'])->name('dashboard.portfolios.destroy');

    Route::get('dashboard/certifications', [CertificationsController::class, 'index'])->name('dashboard.certifications.index');
    Route::get('dashboard/certifications/create', [CertificationsController::class, 'create'])->name('dashboard.certifications.create');
    Route::post('dashboard/certifications', [CertificationsController::class, 'store'])->name('dashboard.certifications.store');
    Route::get('dashboard/certifications/{certification}/edit', [CertificationsController::class, 'edit'])->name('dashboard.certifications.edit');
    Route::put('dashboard/certifications/{certification}', [CertificationsController::class, 'update'])->name('dashboard.certifications.update');
    Route::delete('dashboard/certifications/{certification}', [CertificationsController::class, 'destroy'])->name('dashboard.certifications.destroy');

    Route::get('dashboard/members', [MembersController::class, 'index'])->name('dashboard.members.index');
    Route::get('dashboard/members/create', [MembersController::class, 'create'])->name('dashboard.members.create');
    Route::post('dashboard/members', [MembersController::class, 'store'])->name('dashboard.members.store');
    Route::get('dashboard/members/{member}/edit', [MembersController::class, 'edit'])->name('dashboard.members.edit');
    Route::put('dashboard/members/{member}', [MembersController::class, 'update'])->name('dashboard.members.update');
    Route::delete('dashboard/members/{member}', [MembersController::class, 'destroy'])->name('dashboard.members.destroy');
});

require __DIR__.'/settings.php';

Route::get('/{slug}', [FrontendPageController::class, 'page'])->name('slugpage');
