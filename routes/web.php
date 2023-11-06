<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/auth.php';

Route::group(['middleware' => ['auth', 'active']], function () {
    Route::get('/', HomeController::class)->name('index');
    Route::get('/profile', ProfileController::class)
        ->name('profile.edit');

    Route::resources([
        'users' => UserController::class,
        'teams' => TeamController::class,
        'products' => ProductController::class,
        'campaigns' => CampaignController::class,
        'leads' => LeadController::class,
        'contacts' => ContactController::class,
        'payments' => PaymentController::class,
    ], [
        'except' => [
            'store'
        ]
    ]);

    Route::get('leads/{lead}/move', [LeadController::class, 'move']);

    Route::resource('roles', RoleController::class)
        ->except(['create', 'store', 'show']);
});
