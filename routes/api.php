<?php

use App\Http\Controllers\IssuesController;
use App\Http\Controllers\SystemsController;
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
Route::get('/issues',[IssuesController::class,'index']);
Route::post('/issues',[IssuesController::class,'store']);

Route::get('/systems',[SystemsController::class,'index']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
