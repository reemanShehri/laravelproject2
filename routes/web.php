<?php

use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/' , function(){
        return view('admin.index');
    })->name('index');


    // Route::resource('category' , CategoryController::class) ;
    Route::prefix('category')->name('category.')->group(function (){
        Route::get('/create' , [CategoryController::class , 'create'])->name('category.create');
        Route::get('/getdata' , [CategoryController::class , 'getdata'])->name('category.getdata');
        Route::post('/store' , [CategoryController::class , 'store'])->name('category.store');
        Route::post('/update' , [CategoryController::class , 'update'])->name('category.update');
        Route::delete('/delete/{id}' , [CategoryController::class , 'delete'])->name('category.delete');
    });



});


























Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





require __DIR__ . '/auth.php';
