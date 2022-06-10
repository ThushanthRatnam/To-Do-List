<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ToDoListController;
use App\Http\Controllers\Admin\ToDoItemController;
use App\Http\Controllers\HomeController;

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
//Dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home');
Auth::routes();
Route::group(['prefix' => '', 'middleware' =>  ['auth']],function (){
    

     //Items
     Route::get('items', [ToDoItemController::class,'index']);
     Route::get('item/add', [ToDoItemController::class,'get_add']);
     Route::post('item/add',[ToDoItemController::class,'post_add']);
     Route::get('item/{id}/edit',[ToDoItemController::class,'get_edit']);
     Route::post('item/{id}/edit',[ToDoItemController::class,'post_edit']);
     Route::get('item/{id}/delete',[ToDoItemController::class,'get_delete']);
     Route::get('item/{id}/view', [ToDoItemController::class,'get_view']);
     Route::get('item/status', [ToDoItemController::class,'updateStatus']);
     
     //Item Lists
     Route::get('items/list',  [ToDoListController::class,'index']);
     Route::post('items/list', [ToDoListController::class,'post_add']);
     Route::get('items/list/{id}/edit', [ToDoListController::class,'index']);
     Route::post('items/list/{id}/edit', [ToDoListController::class,'post_edit']);
     Route::get('items/list/{id}/delete', [ToDoListController::class,'get_delete']);
});

