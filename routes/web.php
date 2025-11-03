<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TechnicianController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;

        if ($role === 'admin') {
            return app(AdminController::class)->dashboard();
        } elseif ($role === 'teacher') {
            return app(TeacherController::class)->dashboard();
        } elseif ($role === 'manager') {
            return app(ManagerController::class)->dashboard();
        } elseif ($role === 'technician') {
            return app(TechnicianController::class)->dashboard();
        }

        return view('welcome');
    })->name('dashboard');

    // Teacher Routes
    Route::prefix('teacher')->name('teacher.')->group(function () {
        Route::post('/submit-request', [TeacherController::class, 'submitRequest'])->name('submit-request');
    });

    // Manager Routes
    Route::prefix('manager')->name('manager.')->group(function () {
        Route::post('/convert-to-work-order/{requestId}', [ManagerController::class, 'convertToWorkOrder'])->name('convert-to-work-order');
        Route::get('/print-work-order/{workOrderId}', [ManagerController::class, 'printWorkOrder'])->name('print-work-order');
        Route::patch('/mark-notification-read/{notificationId}', [ManagerController::class, 'markNotificationRead'])->name('mark-notification-read');
    });

    // Technician Routes
    Route::prefix('technician')->name('technician.')->group(function () {
        Route::post('/complete-work-order/{workOrderId}', [TechnicianController::class, 'completeWorkOrder'])->name('complete-work-order');
    });

    // Admin Routes
    Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/locations', [AdminController::class, 'locations'])->name('locations');
        Route::get('/assets', [AdminController::class, 'assets'])->name('assets');
        Route::get('/requests', [AdminController::class, 'requests'])->name('requests');
        Route::get('/work-orders', [AdminController::class, 'workOrders'])->name('work-orders');
        Route::post('/convert-to-work-order/{requestId}', [AdminController::class, 'convertToWorkOrder'])->name('convert-to-work-order');
        Route::post('/complete-work-order/{workOrderId}', [AdminController::class, 'completeWorkOrder'])->name('complete-work-order');
    });
});
