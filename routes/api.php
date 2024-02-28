<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->resource('tasks', TaskController::class)->except([
  'create', 'edit'
]);
Route::get('getByUserId',[TaskController::class,'getByUserId'])
  ->middleware('auth:sanctum');


    
Route::post('register',[UserAuthController::class,'register']);
Route::post('login', [UserAuthController::class, 'login'])->name('login');
Route::post('logout',[UserAuthController::class,'logout'])->name('logout')
  ->middleware('auth:sanctum');
 

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
