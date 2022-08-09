<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\SettingController;

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


// Route::get('/', function () { return view('welcome');});
Route::get('/{any}', function() {return view('app');})->where('any', '.*');
//Route::get('/wanwannokakeibo/index', 'IndexController@index');
Route::get('wanwannokakeibo', [LoginController::class, 'index']);
Route::get('wanwannokakeibo/index', [IndexController::class, 'index']);
Route::post('wanwannokakeibo/index', [IndexController::class, 'post']);
Route::get('wanwannokakeibo/login', [LoginController::class, 'index']);
Route::post('wanwannokakeibo/login', [LoginController::class, 'post']);
Route::get('wanwannokakeibo/userRegistration', [UserRegistrationController::class, 'index']);
Route::post('wanwannokakeibo/userRegistration', [UserRegistrationController::class, 'post']);
Route::get('wanwannokakeibo/input', [InputController::class, 'index']);
Route::post('wanwannokakeibo/insert', [InputController::class, 'insert']);
Route::post('wanwannokakeibo/update', [InputController::class, 'update']);
Route::post('wanwannokakeibo/delete', [InputController::class, 'delete']);
Route::get('wanwannokakeibo/registration', [RegistrationController::class, 'index']);
Route::post('wanwannokakeibo/item-insert', [RegistrationController::class, 'insert']);
Route::post('wanwannokakeibo/item-update', [RegistrationController::class, 'update']);
Route::post('wanwannokakeibo/item-delete', [RegistrationController::class, 'delete']);
Route::get('wanwannokakeibo/list', [ListController::class, 'index']);
Route::post('wanwannokakeibo/list', [ListController::class, 'post']);
Route::get('wanwannokakeibo/setting', [SettingController::class, 'index']);
Route::post('wanwannokakeibo/setting', [SettingController::class, 'post']);
Route::get('wanwannokakeibo/logout', [LoginController::class, 'logout']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
