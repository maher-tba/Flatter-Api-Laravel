<?php

use App\Http\Controllers\User\TaskController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=> 'auth'], function (){
   Route::group([
       'prefix' => 'admin',
       'middleware'=>'is_admin',
       'as'=>'admin.',
   ], function (){
       Route::resource('tasks', \App\Http\Controllers\Admin\TaskController::class);

   });

    Route::group([
        'prefix' => 'user',
        'as'=>'user.',
    ], function (){
        Route::resource('tasks', TaskController::class);
    });
});
//Route::get('/sendTask', [
//    'uses' => 'TaskController@tasksUser',
//    'as' => 'tasks.admin',
//    'middleware' => 'roles',
//    'roles' => ['Admin']
//]);
//
//Route::post('/tasks','TaskController@store')->name('tasks.store'); // making a post request
//Route::get('/tasks/{id}/edit','TaskController@edit')->name('tasks.edit');
//Route::post('/tasks/{id}', 'TaskController@update')->name('tasks.update');
//Route::get('/tasks','TaskController@index')->name('tasks.index');
//Route::post('/send/{user}/{author}', 'TaskController@sendMessageToUser')->name('tasks.send');

//Route::group(['middleware'=> 'auth'], function() {
//    Route::resource('tasks', 'TaskController', [
//        'only' => [
//            'index', 'store', 'update','edit'
//        ]
//    ]);
//});





