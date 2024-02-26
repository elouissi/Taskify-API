<?php

use App\Http\Controllers\Api\TaskController;
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

Route::group(['middleware' => 'auth:api', 'namespace' =>'Api'],function(){
    
    Route::post('Create_tasks','TaskController@store');
    Route::put('Update_task/{id}','TaskController@update');
    Route::delete('Delete_tasks/{id}','TaskController@destroy');

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('Get_ALL_tasks',[TaskController::class,'index']);