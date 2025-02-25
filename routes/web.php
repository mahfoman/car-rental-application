<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;

use App\Http\Controllers\Frontend\CarController as FrontendCarController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\RentalController as FrontendRentalController;

use App\Http\Controllers\Frontend\UserController;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isCustomer;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\SessionAuthenticate;


Route::prefix('admin')
    ->middleware([SessionAuthenticate::class, isAdmin::class])
    ->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Car Management
    Route::resource('cars', AdminCarController::class);

    // Rental Management
    Route::resource('rentals', AdminRentalController::class);

    // Customer Management
    Route::resource('customers', CustomerController::class);
});

Route::get('/login', [UserController::class, 'LoginPage'])->name('LoginPage');
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
//Route::get('/user-logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('/register', [UserController::class, 'RegistrationPage'])->name('RegistrationPage');
Route::post('/user-register', [UserController::class, 'register'])->name('user.register');



Route::get('/', [PageController::class, 'home'])->name('HomePage');
Route::get('/about', [PageController::class, 'about'])->name('AboutPage');
Route::get('/contact', [PageController::class, 'contact'])->name('ContactPage');
Route::post('/contact', [PageController::class, 'contact_store'])->name('ContactPage.store');

Route::get('/cars', [FrontendCarController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}', [FrontendCarController::class, 'show'])->name('cars.show');

Route::middleware([SessionAuthenticate::class, isCustomer::class])->group(function () {
    Route::get('/rentals', [FrontendRentalController::class, 'index'])->name('rentals.index');
    Route::post('/rentals', [FrontendRentalController::class, 'store'])->name('rentals.store');
    Route::delete('/rentals/{id}', [FrontendRentalController::class, 'destroy'])->name('rentals.destroy');
});

