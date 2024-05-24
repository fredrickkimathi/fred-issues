<?php

use App\Http\Controllers\IssuesController;
use App\Http\Controllers\IssueTypeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReportedIssuesController;
use App\Http\Controllers\AllIssuesController;
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

Route::get('/issue_types',[IssueTypeController::class,'index']);

Route::get('/systems',[SystemsController::class,'index']);


Route::get('/users',[UsersController::class,'index']);

Route::get('/displayissues',[ReportedIssuesController::class,'index']);

Route::get('/allissues',[AllIssuesController::class,'index']);

Route::get('/priorities', [IssuesController::class, 'getPriorities']);
Route::put('/issues/{issue}/priority', [IssuesController::class, 'setPriority']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
