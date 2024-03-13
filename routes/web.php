<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InstitutoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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


//Route::get('users', [UserController::class, 'index'])->name('users.index');

//Route::get('user-ban-unban/{id}/{status}', [UserController::class, 'banUnban'])->name('user.banUnban');

//Back-end

/*Route::get('/admin', function () {
    return view('admin/index');
});*/

//Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::post('salir', [LoginController::class, 'salir'])->name('salir');

Route::group(['prefix' => 'admin','as' => 'admin.','middleware'=>['auth']],function(){
    Route::get('/', [AdminController::class, 'index']);
    Route::post('logout', [LoginController::class, 'salir'])->name('salir');
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::post('users', [UserController::class, 'index'])->name('users');
    Route::get('user-ban-unban/{id}/{status}', [UserController::class, 'banUnban'])->name('users.banUnban');
    Route::get('user-create', [UserController::class, 'create'])->name('users.create');
    Route::get('user-edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('user-update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('institutos', [InstitutoController::class, 'index'])->name('institutos');
});
/*Route::group(
    ['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']],
    function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('users', [UserController::class, 'index'])->name('users');
        Route::get('user-ban-unban/{id}/{status}', [UserController::class, 'banUnban'])->name('user.banUnban');
        //Route::put('activeUser', [UserController::class, 'activeUser'])->name('activeUser');
        //Route::put('inactiveUser', [UserController::class, 'inactiveUser'])->name('inactiveUser');
        Route::get('institutos', [InstitutoController::class, 'index'])->name('institutos');
    }
);*/
