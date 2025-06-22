<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\UserDashboardController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('teams', TeamController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', TaskController::class);
    Route::get('tasks/{task}/assign', [TaskController::class, 'assign'])->name('tasks.assign');
    Route::post('tasks/{task}/assign', [TaskController::class, 'storeAssignment'])->name('tasks.storeAssignment');
    Route::get('/activity-logs', [TaskController::class, 'showActivityLog'])->name('activity-logs.index');

    // Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
});

Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/user-dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('teams/{team}/projects', [UserDashboardController::class, 'listProject'])->name('teams.projects');
    Route::get('projects/{project}/tasks', [UserDashboardController::class, 'listTask'])->name('projects.tasks');

    // Route::get('/teams/{team}/projects', [UserDashboardController::class, 'teamProjects'])->name('teams.projects');
    // Route::get('/projects/{project}/tasks', [UserDashboardController::class, 'projectTasks'])->name('projects.tasks');
    // Route::patch('/tasks/{task}/status', [UserDashboardController::class, 'updateTaskStatus'])->name('tasks.update-status');
});

require __DIR__.'/auth.php';
