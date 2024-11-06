<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticaleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\BlockRegionController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PortfolioItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TimelineEventController;
use App\Http\Controllers\UserController;
use App\Models\Carousel;
use App\Models\Navigation;
use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\TimelineEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', function () {
    $carousels = Carousel::where('is_active', 1)->get();
    $services = Service::where('is_active', 1)->get();
    $navigations = Navigation::where('is_active', 1)->get();
    $portfolioItems = PortfolioItem::where('is_active', 1)->get();
    $timelineEvents = TimelineEvent::where('is_active', 1)->get();
    return view('frontend.layouts.main', compact('carousels', 'services', 'navigations', 'portfolioItems','timelineEvents'));
});

Auth::routes();

/* ----------------- Admin -----------------*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'adminlogin'])->name('admin_login');
    Route::post('/login/owner', [AdminController::class, 'login'])->name('admin.login');
    Route::get('/', [AdminController::class, 'Dashboard'])->name('home')->middleware('admin');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('admin');



    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('articale', ArticaleController::class);
    Route::resource('user', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('blockRegions', BlockRegionController::class);
    Route::resource('blocks', BlockController::class);
    Route::resource('carousels', CarouselController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('navigations', NavigationController::class);
    Route::resource('portfolio', PortfolioItemController::class);
    Route::resource('timeline-events', TimelineEventController::class);
    Route::resource('contacts', ContactController::class);
});



