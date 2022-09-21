<?php

use App\Http\Controllers\TaskListController;
use App\Http\Controllers\TaskListItemController;
use App\Http\Controllers\WorkspaceController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
Route::get('/workspace', [WorkspaceController::class, 'userSelectedWorkspace'])->name('workspace');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::put('/workspace-select', [WorkspaceController::class, 'select'])->name('workspace-select.update');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
     Route::put('/task_list-move_item', [TaskListController::class, 'move'])->name('task_list-move_item');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
     Route::post('/workspace.create', [WorkspaceController::class, 'create'])->name('workspace.create');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
     Route::post('/task_list_item.create', [TaskListItemController::class, 'create'])->name('task_list_item.create');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
     Route::delete('/task_list_item.delete/{id}', [TaskListItemController::class, 'delete'])->name('task_list_item.delete');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
     Route::post('/task_list.create', [TaskListController::class, 'create'])->name('task_list.create');
});

// Route::get('/teste', [TaskListController::class, 'gambiteste'])->name('teste');