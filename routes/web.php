<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('tasks', TaskController::class);
Route::patch('tasks/{task}/complete', [TaskController::class, 'markAsComplete'])->name('tasks.complete');
Route::patch('tasks/{task}/pending', [TaskController::class, 'markAsPending'])->name('tasks.pending');
Route::get('tasks/status/{status}', [TaskController::class, 'filterByStatus'])->name('tasks.filterByStatus');
