<?php
// namespace App\Http\Controller;
use App\Http\Controllers\HomeController;

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

Route::get('/',[HomeController::class, 'index'])-> name('home.index');

Route::get('/form', [HomeController::class, 'create'])-> name('home.create');

Route::post('/book/new',[HomeController::class, 'store']);

Route::get('/book/{book}/edit', [HomeController::class, 'edit'])-> name('home.edit');

Route::put('/book/{book}', [HomeController::class, 'update']);

Route::delete('/book/{book}', [HomeController::class, 'destroy']);