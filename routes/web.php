<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;

Route::get('/', function () {
    return view('welcome');
});


/*Route::get('/about', function () {
   echo "About Page";
});


Route::get('/main/{value}',[MainController::class,'index']);

Route::get('/page2/{value}',[MainController::class,'page2']);
Route::get('/page3/{value}',[MainController::class,'page3']);  */


// Auth Routes
Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);

});

Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');
    Route::post('/newNoteSubmit', [MainController::class, 'newNoteSubmit'])->name('newNoteSubmit');

    //edit note
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('edit');


    //Delete Note
    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('delete');


    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
