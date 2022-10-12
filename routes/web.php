<?php

use App\Http\Controllers\KaryawanController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/karyawan', [KaryawanController::class, 'index']);
Route::get('/ajax', [KaryawanController::class, 'ajax']);
Route::get('/ajax_table', [KaryawanController::class, 'ajax_table']);
Route::get('/karyawan/create', [KaryawanController::class, 'create']);
Route::post('/karyawan/create', [KaryawanController::class, 'store']);