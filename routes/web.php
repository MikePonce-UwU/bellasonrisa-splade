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
            // 'canRegister' => Route::has('register'),
            'canRegister' => false,
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    });
    Route::get('/matricula-en-linea', [\App\Http\Controllers\MatriculaController::class, 'index'])->name('matricula.index');
    Route::post('/matricula-en-linea', [\App\Http\Controllers\MatriculaController::class, 'store'])->name('matricula.store');

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::view('/dashboard', 'dashboard')->name('dashboard');
        Route::group([
            'prefix' => 'admin/',
            'middleware' => 'role:admin|Administrador',
        ], function () {
            Route::resource('grades', \App\Http\Controllers\GradeController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
            Route::resource('students', \App\Http\Controllers\StudentController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
            Route::resource('subjects', \App\Http\Controllers\SubjectController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
            // Route::resource('tutors', \App\Http\Controllers\TutorController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
            Route::resource('users', \App\Http\Controllers\UserController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
            if (\App\MKPonce\MKPonce::supportsRolesManagement())
                Route::resource('roles', \App\Http\Controllers\RoleController::class)->only(['index', 'store', 'show', 'update']);
            if (\App\MKPonce\MKPonce::supportsPermissionsManagement())
                Route::resource('permissions', \App\Http\Controllers\PermissionController::class)->only(['index', 'store',]);
        });
        Route::group(['middleware' => 'role:Administrador|Sub-director|Director|Auxiliar contable'], function () {
            if (\App\MKPonce\MKPonce::supportsInvoicesManagement())
                Route::resource('invoices', \App\Http\Controllers\InvoiceController::class)->only(['index', 'store', 'show', 'update']);
        });
        Route::group(['middleware' => 'role:Padre de familia|Maestro'], function () {
            Route::get('my-invoices', function () {
                $invoices = auth()->user()->invoices()->where(['tipo_factura' => 'matricula'])->orWhere(['tipo_factura' => 'arancel'])->orderBy('created_at', 'desc')->get();
                return view('pages.my-invoices', [
                    'invoices' => \ProtoneMedia\Splade\SpladeTable::for($invoices)
                        ->column('numero_factura', label: '#')
                        ->column('razon', label: 'A razón de')
                        ->column('total_factura', label: 'Total facturado')
                        ->column('created_at', label: 'Facturado')
                        ->column('tipo_factura', label: 'Tipo de factura')
                ]);
            })->name('my-invoices.show');
        });
        Route::group(['middleware' => 'role:Director|Sub-director|Administrador|Auxiliar contable'], function () {
            Route::get('accountability', function () {
                $entradas = \App\Models\Invoice::where(['income' => true])->get();
                $salidas = \App\Models\Invoice::where(['income' => false])->get();
                return view('pages.accountability', [
                    'entradas' => $entradas->sum('total_factura'),
                    'salidas' => $salidas->sum('total_factura'),
                ]);
            })->name('accountability.show');
        });
        Route::group(['middleware' => 'role:Director|Administrador'], function () {
            Route::resource('user_details', \App\Http\Controllers\UserDetailController::class)->only(['index', 'store', 'show', 'update']);
        });
        Route::group(['middleware' => 'role:Maestro|Administrador'], function () {
            Route::get('calificaciones', \App\Http\Livewire\CalificacionesController::class)->name('calificaciones.index');

        });
    });
});
