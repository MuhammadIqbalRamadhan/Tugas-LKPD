<?php

use Illuminate\Support\Facades\Route;
// use App\Models\Data;
use App\Http\Controllers\DataController;

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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/index', [DataController::class, 'index'])->name('index');


Route::group(['middleware' => ['auth', 'CheckRole:admin']], function () {
    Route::get('/tambah', [DataController::class, 'tambah']);
    Route::post('/simpan', [DataController::class, 'simpan'])->name('simpan_data');
    Route::delete('/delete{id}', [DataController::class, 'delete']);
    Route::get('/edit/{id}', [DataController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [DataController::class, 'update'])->name('update');
});
// route