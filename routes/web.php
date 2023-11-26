<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ResponsableController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['web', 'auth', 'employee']], function () {
    Route::get('/employee/dashboard', [EmployeeController::class, 'index'])->name('employee.dashboard');
    Route::get('employee/leaves/create', [EmployeeController::class, 'createLeaveDemande'])->name('leaves.create');
    Route::post('/employee/leaves', [EmployeeController::class, 'storeLeaveDemande'])->name('leaves.store');
    Route::post('/employee/leaves/authorization', [EmployeeController::class, 'storeAuthorization'])->name('employee.storeAuthorization');
});

Route::group(['middleware' => ['web', 'auth', 'responsable']], function () {
    Route::get('/responsable/dashboard', [ResponsableController::class, 'index'])->name('responsable.dashboard');
    Route::get('/responsable/employees', [ResponsableController::class, 'create'])->name('employee.create');
    Route::post('/responsable/employees/create', [ResponsableController::class, 'store'])->name('employee.store');
    Route::get('/responsable/employees/{id}/edit', [ResponsableController::class, 'edit'])->name('employee.edit');
    Route::put('/responsable/employees/{id}/update', [ResponsableController::class, 'update'])->name('employee.update');
});
