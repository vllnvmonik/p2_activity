<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::get('/', [AuthController::class, 'registration'])-> name('registration');

Route::get('/login', [AuthController::class, 'login'])-> name('login');
Route::post('/login', [AuthController::class, 'loginPost'])-> name('login.post');

Route::get('/registration', [AuthController::class, 'registration'])-> name('registration');
Route::post('/registration', [AuthController::class, 'registrationPost'])-> name('registration.post');

Route::get('/welcome', [AuthController::class, 'welcome'])-> name('welcome');

Route::get('/logout', [AuthController::class, 'logout'])-> name('logout');

