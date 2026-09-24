<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/profile', [DashboardController::class, 'profile'])->name('admin.profile');


Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('admin.students.index');
    Route::get('/create', [StudentController::class, 'create'])->name('admin.students.create');
    Route::post('/store', [StudentController::class, 'store'])->name('admin.students.store');
    Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('admin.students.edit');
    Route::put('/{id}', [StudentController::class, 'update'])->name('admin.students.update');
    Route::get('/{id}', [StudentController::class, 'destroy'])->name('admin.students.destroy');
    Route::get('/{id}/view', [StudentController::class, 'show'])->name('admin.students.view');
});


