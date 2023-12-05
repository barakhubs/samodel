<?php

use App\Http\Controllers\MainController;
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

// Route::get('/', function () {
//     return view('app');
// });

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/post/{slug}', [MainController::class, 'singlePost'])->name('single');
Route::get('/category/{slug}', [MainController::class, 'singleCategory'])->name('category.single');
Route::post('/comment/{post}', [MainController::class, 'commentStore'])->name('comment.store');
Route::get('/comments', [MainController::class, 'comments'])->name('comment.list');
Route::get('/password-checker', [MainController::class, 'passwordChecker'])->name('password-checker');
Route::get('/password-generator', [MainController::class, 'passwordGenerator'])->name('password-generator');
Route::get('/file-scanner', [MainController::class, 'fileScanner'])->name('file-scanner');
Route::get('/url-scanner', [MainController::class, 'urlScanner'])->name('url-scanner');
