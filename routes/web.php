<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Login function from CustomAuthController.php in controllers folder is called here
Route::get('/login', [CustomAuthController::class, 'login']);

// Registration function from CustomAuthController.php in controllers folder is called here
Route::get('/registration', [CustomAuthController::class, 'registration']);

Route::post('/register-user', [CustomAuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [CustomAuthController::class, 'loginUser'])->name('login-user');

// Dashboard function from CustomAuthController.php in controllers folder is called here
Route::get('/dashboard', [CustomAuthController::class, 'dashboard']);

// Logout function from CustomAuthController.php in controllers folder is called here
Route::get('/logout', [CustomAuthController::class, 'logout']);
