<?php

use Illuminate\Foundation\Application;
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

Route::middleware(['splade'])->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return view('welcome', [
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
        Route::view('/dashboard', 'dashboard')->name('dashboard');
        Route::group([
            'prefix' => 'admin/',
            'middleware' => 'role:admin|Administrador',
        ], function() {
            Route::resource('grades', \App\Http\Controllers\GradeController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
            Route::resource('students', \App\Http\Controllers\StudentController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
            Route::resource('subjects', \App\Http\Controllers\SubjectController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
            Route::resource('tutors', \App\Http\Controllers\TutorController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
            Route::resource('users', \App\Http\Controllers\UserController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
            Route::resource('roles', \App\Http\Controllers\RoleController::class)->only(['index', 'store', 'show', 'update']);
            Route::resource('permissions', \App\Http\Controllers\PermissionController::class)->only(['index', 'store',]);
        });
    });
});
