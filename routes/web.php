<?php

use App\Http\Controllers\DormitoryController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\StudentDormitoryController;
use App\Http\Controllers\UserController;
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



Route::middleware(['auth'])->group(function(){

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // dormitory controller 
    Route::controller(DormitoryController::class)->prefix('dormitory')->group(function () {
        Route::get('/', 'index')->name('dormitory.index');
        Route::get('/create', 'create')->name('dormitory.create');
        Route::post('/store', 'store')->name('dormitory.store');
        Route::get('/edit/{id}', 'edit')->name('dormitory.edit');
        Route::put('/update/{id}', 'update')->name('dormitory.update');
        Route::delete('/delete/{id}', 'delete');
        Route::post('/search', 'search')->name('dormitory.search');
    });

    // room type controller 
    Route::controller(RoomTypeController::class)->prefix('room-type')->group(function(){
        Route::get('/', 'index')->name('room-type.index');
        Route::get('/create', 'create')->name('room-type.create');
        Route::post('/store', 'store')->name('room-type.store');
        Route::get('/edit/{id}', 'edit')->name('room-type.edit');
        Route::put('/update/{id}', 'update')->name('room-type.update');
        Route::delete('/delete/{id}', 'delete');
        Route::post('/search', 'search')->name('room-type.search');
    });

    // room type controller 
    Route::controller(RoomController::class)->prefix('room')->group(function(){
        Route::get('/', 'index')->name('room.index');
        Route::get('/create', 'create')->name('room.create');
        Route::post('/store', 'store')->name('room.store');
        Route::get('/edit/{id}', 'edit')->name('room.edit');
        Route::put('/update/{id}', 'update')->name('room.update');
        Route::delete('/delete/{id}', 'delete');
        Route::post('/search', 'search')->name('room.search');
    });

    // student dormitory controller 
    Route::controller(StudentDormitoryController::class)->prefix('student-dormitory')->group(function(){
        Route::get('/', 'index')->name('student-dormitory.index');
        Route::get('/create', 'create')->name('student-dormitory.create');
        Route::post('/store', 'store')->name('student-dormitory.store');
        Route::get('/edit/{id}', 'edit')->name('student-dormitory.edit');
        Route::put('/update/{id}', 'update')->name('student-dormitory.update');
        Route::delete('/delete/{id}', 'delete');
        Route::post('/get-room-by-dormitory','getRoomByDormitory');
        Route::post('/search', 'search')->name('student-dormitory.search');

    });

    // user controller controller 
    Route::controller(UserController::class)->prefix('user')->group(function(){
        Route::get('/', 'index')->name('user.index');
        Route::get('/create', 'create')->name('user.create');
        Route::post('/store', 'store')->name('user.store');
        Route::get('/edit/{id}', 'edit')->name('user.edit');
        Route::put('/update/{id}', 'update')->name('user.update');
        Route::delete('/delete/{id}', 'delete');
    });


});

require __DIR__.'/auth.php';
