<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
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

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth','verified'])->name('home');

Route::prefix('post')->name('post.')->group(function (){
    Route::get('/all',[PostController::class,'show'])->name('show');

    Route::get('create',[PostController::class, 'create'])->name('create');
    Route::post('create/post',[PostController::class, 'store'])->name('createFun');

    Route::get('edit/{id}',[PostController::class,'editById'])->name('edit');
    Route::post('edit',[PostController::class,'edit'])->name('updateFun');

    Route::get('delete/{id}',[PostController::class, 'destroy'])->name('delete');
});

Route::prefix('/admin')->name('admin.')->group(function (){
    Route::get('/',[PermissionController::class,'show'])->name('admin');

    Route::get('user/',[PermissionController::class,'user'])->name('add');
    Route::post('user/add',[PermissionController::class,'adduser'])->name('addFun');

});
