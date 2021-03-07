<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;

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


Route::get('/', function () { return view('welcome');});
//Route::get('/wanwannokakeibo/index', 'IndexController@index');
Route::get('wanwannokakeibo/index', [IndexController::class, 'index']);
Route::post('wanwannokakeibo/index', [IndexController::class, 'post']);
Route::get('wanwannokakeibo/login', [LoginController::class, 'index']);
Route::post('wanwannokakeibo/login', [LoginController::class, 'post']);
Route::get('wanwannokakeibo/input', [InputController::class, 'index']);
Route::post('wanwannokakeibo/input', [InputController::class, 'post']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
