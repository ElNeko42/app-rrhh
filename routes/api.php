<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckTimeController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\NotificationController;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkplaceController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckTimeReportController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/auth-user', function (Request $request) {
//  return auth('api')->user();
//
//});

// -----------------------
// Auth
// -----------------------
Route::middleware('auth')->get('/auth-user', function (Request $request) {
  return $request->user('api');
});

Route::get('/roles', function (Request $request) {
  return Role::all();
});

// -----------------------
// Private Pages
// -----------------------
Route::middleware('api')->group(function () {
  Route::resource('users', UserController::class);
  Route::put('/users/activate/{user}', [UserController::class, 'activate']);
  Route::put('/users/deactivate/{user}', [UserController::class, 'deactivate']);
  Route::put('/users/reset-password/{user}', [UserController::class, 'resetPassword']);
});

Route::middleware('api')->group(function () {
  Route::resource('workplaces', WorkplaceController::class);
});
Route::get('/wp-code', [WorkplaceController::class, 'getAvaliableCode']);

Route::middleware('api')->group(function () {
  Route::resource('workers', WorkerController::class);
});

Route::middleware('api')->resource('dashboard', DashboardController::class);

// -----------------------
// Notifications
// -----------------------
Route::post('/notifications/read/{id}', [NotificationController::class, 'read']);
Route::post('/notifications/send', [NotificationController::class, 'send']);

// -----------------------
// Storage Files.
// -----------------------
Route::post('laravel-filemanager/view', [FileManagerController::class, 'viewFile']);
Route::get('laravel-filemanager/username', [FileManagerController::class, 'getUserName']);

// -----------------------
// Logs
// -----------------------
Route::get('/logs/{user}', [UserController::class, 'getLogs']);

// -----------------------
// CheckTime
// -----------------------
Route::post('/check-time', [CheckTimeController::class, 'postCheckTime']);
Route::put('/update-time/{user}', [CheckTimeController::class, 'updateTime']);
Route::get('/check-time/{user}', [CheckTimeController::class, 'isCheck']);
Route::delete('/checktime/{id}', [CheckTimeController::class, 'deleteCheckTime']);
// -----------------------
// Reports
Route::get('/reports/worker-workplace-names', [CheckTimeReportController::class, 'getWorkersAndWorkplaces']);
Route::get('/reports/check-time-today', [CheckTimeReportController::class, 'getCheckTimeToday']);
Route::post('/reports/check-time-worker', [CheckTimeReportController::class, 'getCheckTimeWorker']);
Route::post('/reports/check-time-workerplace', [CheckTimeReportController::class, 'getCheckTimeWorkerplace']);
Route::post('/reports/report-edit-check-time', [CheckTimeReportController::class, 'reportEditCheckTime']);
Route::post('/reports/create-check-time', [CheckTimeReportController::class, 'createCheckTime']);

