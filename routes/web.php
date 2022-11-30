<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\SiswaController;



// Route::get('/',
// return view('dasboard.index');
// );


Route::middleware('isGuest')->group(function()  {
    Route::get('/', [SiswaController::class, 'login'])->name('login');
    // Route::get('login', [SiswaController::class, 'login']);
    Route::get('register', [SiswaController::class, 'register']);
    Route::post('register', [SiswaController::class, 'inputRegister'])->name('register.post');
    Route::post('/login', [SiswaController::class, 'auth'])->name('login.auth');
});
Route::get('/logout', [SiswaController::class, 'logout'])->name('logout');
// Route::post('/siswa', [SiswaController::class, 'index'])->name('siswa.index');


Route::middleware('isLogin')->prefix('/todo')->name('todo.')->group(function () {
    Route::get('/', [SiswaController::class, 'index'])->name('index');
    Route::get('/complated', [SiswaController::class, 'complated'])->name('complated');
    Route::get('/create', [SiswaController::class, 'create'])->name('create');
    Route::post('/store', [SiswaController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [SiswaController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [SiswaController::class, 'update'])->name('update');
    Route::delete('/delete/{id}',  [SiswaController::class, 'destroy'])->name('delete');
    Route::patch('/complated/{id}',  [SiswaController::class, 'updateComplated'])->name('update-complated');

});//tambah data ke database 


