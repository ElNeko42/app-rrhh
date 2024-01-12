<?php

use App\Http\Controllers\ImportExportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use UniSharp\LaravelFilemanager\Lfm;

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

// -----------------------
// Main Page.
// -----------------------
Route::get('/', [PageController::class, 'home'])->name('home');

// -----------------------
// Auth Pages.
// -----------------------
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login-process', [AuthController::class, 'loginProcess'])->name('login-process');
//Route::get('registration', [AuthController::class, 'registration'])->name('register');
//Route::post('registration-process', [AuthController::class, 'registrationProcess'])->name('register-process');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// -----------------------
// Private Pages.
// -----------------------
Route::get('inicio', [PageController::class, 'welcome']);
Route::get('dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('centros-trabajo{any}', [PageController::class, 'workplaces'])->where('any', '.*');
Route::get('trabajadores{any}', [PageController::class, 'workers'])->where('any', '.*');
Route::get('usuarios{any}', [PageController::class, 'users'])->where('any', '.*');
Route::post('change-password-process', [UserController::class, 'changePasswordProcess'])->name('change-password-process');
Route::get('check-time', [PageController::class, 'checkTime'])->name('check-time');
Route::get('check-time-report', [PageController::class, 'checkTimeReport'])->name('check-time-report');
Route::get('change-log', [PageController::class, 'changeLog'])->name('change-log');

// -- Import / Export
Route::get('migrar-centros', [PageController::class, 'importExportWorkplaces']);
Route::get('exportar-centros-process', [ImportExportController::class, 'exportWorkplaces'])->name('exportar-centros-process');
Route::post('importar-centros-process', [ImportExportController::class, 'importWorkplaces'])->name('importar-centros-process');
Route::get('migrar-trabajadores', [PageController::class, 'importExportWorkers']);
Route::get('exportar-trabajadores-process', [ImportExportController::class, 'exportWorkers'])->name('exportar-trabajadores-process');
Route::post('importar-trabajadores-process', [ImportExportController::class, 'importWorkers'])->name('importar-trabajadores-process');
Route::get('importar-nominas', [PageController::class, 'importPayrolls']);
Route::post('importar-nominas-process', [ImportExportController::class, 'importPayrolls'])->name('importar-nominas-process');

// -- File Manager
Route::get('documentacion', [PageController::class, 'fileManager'])->name('documentacion');

// -- Notificaciones
Route::get('notificaciones', [PageController::class, 'notifications'])->name('notificaciones');
Route::get('enviar-notificacion', [PageController::class, 'sendNotification'])->name('enviar-notificacion');

// -- File Verification
Route::get('verificacion-acceso-ficheros', [PageController::class, 'checkFilesAccess'])->name('verificacion-acceso-ficheros');

// -----------------------
// Public Pages.
// -----------------------
Route::get('vue-sample', [PageController::class, 'vueSample']);

// -----------------------
// Storage Files.
// -----------------------
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
  Lfm::routes();
});

