<?php

use App\Http\Controllers\ToDoController;
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

Route::get('/', [ToDoController::class, 'getAll']);
Route::post('/add', [ToDoController::class, 'add']);
Route::post('/update', [ToDoController::class, 'save']);
Route::put('/todo/{todo}', [ToDoController::class, 'edit']);
Route::put('/completed/{id}', [ToDoController::class, 'completed']);
Route::delete('/todo/{id}', [ToDoController::class, 'delete']);
Route::get('/random', [ToDoController::class, 'random']);
