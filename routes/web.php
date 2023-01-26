<?php
namespace App\Http\Controller;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

use Illuminate\Support\Facades\Route;

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

// Route::get('/db',[HomeController::class, 'db']);

Route::get('/',[HomeController::class, 'index']) -> name('home.index');

Route::get('/search',[HomeController::class, 'search']);

Route::prefix('book') -> group(function () {
    Route::get('/create', [HomeController::class, 'create']) -> middleware('auth') -> name('book.create');

    Route::post('',[HomeController::class, 'store']);

    Route::get('/{book_id}/edit', [HomeController::class, 'edit']) -> name('book.edit');

    Route::put('/{book_id}', [HomeController::class, 'update']);

    Route::delete('/{book_id}', [HomeController::class, 'destroy']);

    Route::get('/{book_id}/log', [HomeController::class, 'findLog']);
});

Route::get('/login', [LoginController::class, 'login']) -> name('login');

Route::post('/login', [LoginController::class, 'enter']);

Route::get('/signup', [LoginController::class, 'signup']) -> name('signup');

Route::post('/signup', [LoginController::class, 'store']);

Route::post('/logout', [LoginController::class, 'exit']) -> name('exit');

