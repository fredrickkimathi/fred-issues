<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IssuesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/issues/create', [IssuesController::class, 'create'])->name('issues.create');
    Route::post('/issues', [IssuesController::class, 'store'])->name('issues.store');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/Report', function () {
    return Inertia::render('Report');
})->middleware(['auth', 'verified'])->name('report');


Route::get('/Admin/AssignTask', function () {
    return Inertia::render('Admin/AssignTask');
})->middleware(['auth', 'verified', 'role:3'])->name('assigntask');

Route::get('/admindashboard', function () {
    return Inertia::render('AdminDashboard');
})->middleware(['auth', 'verified', 'role:3'])->name('admindashboard');

Route::get('/staffdashboard', function () {
    return Inertia::render('StaffDashboard');
})->middleware(['auth', 'verified', 'role:2'])->name('staffdashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
