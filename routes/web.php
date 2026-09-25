<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\TeacherCourseController;
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


Route::prefix('teachers')->group(function () {
    Route::get('/', [TeacherController::class, 'index'])->name('admin.teachers.index');
    Route::get('/create', [TeacherController::class, 'create'])->name('admin.teachers.create');
    Route::post('/store', [TeacherController::class, 'store'])->name('admin.teachers.store');
    Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
    Route::put('/{id}', [TeacherController::class, 'update'])->name('admin.teachers.update');
    Route::get('/{id}', [TeacherController::class, 'destroy'])->name('admin.teachers.destroy');
    Route::get('/{id}/view', [TeacherController::class, 'show'])->name('admin.teachers.view');
});

Route::prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/create', [CourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/store', [CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('admin.courses.edit');
    Route::put('/{id}', [CourseController::class, 'update'])->name('admin.courses.update');
    Route::get('/{id}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');
    Route::get('/{id}/view', [CourseController::class, 'show'])->name('admin.courses.view');
});

Route::prefix('teacher-courses')->group(function () {
    Route::get('/', [TeacherCourseController::class, 'index'])->name('admin.teacher-courses.index');
    Route::get('/create', [TeacherCourseController::class, 'create'])->name('admin.teacher-courses.create');
    Route::post('/store', [TeacherCourseController::class, 'store'])->name('admin.teacher-courses.store');
    Route::get('/{id}/edit', [TeacherCourseController::class, 'edit'])->name('admin.teacher-courses.edit');
    Route::put('/{id}', [TeacherCourseController::class, 'update'])->name('admin.teacher-courses.update');
    Route::get('/{id}', [TeacherCourseController::class, 'destroy'])->name('admin.teacher-courses.destroy');
    Route::get('/{id}/view', [TeacherCourseController::class, 'show'])->name('admin.teacher-courses.view');
});