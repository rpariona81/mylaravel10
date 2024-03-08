<?php

use App\Http\Controllers\Auth\LoginController;
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

//Front-end
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
});

/*Route::get('/login', function () {
    return view('auth/login');
});*/

Route::get('login', [LoginController::class, 'acceder'])->name('login');

Route::post('login', [LoginController::class, 'autenticar'])->name('autenticar');

/*Route::post('/login', function () {
    return view('auth/login');
})->name(('login'));*/

Route::get('/register', function () {
    return view('auth/register');
});

Route::post('/register', function () {
    return view('auth/register');
})->name(('register'));


Route::get('users', [UserController::class, 'index'])->name('users.index');

Route::get('user-ban-unban/{id}/{status}', [UserController::class, 'banUnban'])->name('user.banUnban');

//Back-end

