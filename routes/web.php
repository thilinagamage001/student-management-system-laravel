<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\TeacherCourseController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\QuizQuestionController;
use Illuminate\Support\Facades\Route;



Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
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

Route::prefix('enrollments')->group(function () {
    Route::get('/', [EnrollmentController::class, 'index'])->name('admin.enrollments.index');
    Route::get('/create', [EnrollmentController::class, 'create'])->name('admin.enrollments.create');
    Route::post('/store', [EnrollmentController::class, 'store'])->name('admin.enrollments.store');
    Route::get('/{id}/edit', [EnrollmentController::class, 'edit'])->name('admin.enrollments.edit');
    Route::put('/{id}', [EnrollmentController::class, 'update'])->name('admin.enrollments.update');
    Route::get('/{id}', [EnrollmentController::class, 'destroy'])->name('admin.enrollments.destroy');



});


Route::prefix('attendance')->group(function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('admin.attendance.index');
    Route::get('/create', [AttendanceController::class, 'create'])->name('admin.attendance.create');
    Route::get('/students', [AttendanceController::class, 'getStudents'])->name('admin.attendance.getstudents');
    Route::post('/store', [AttendanceController::class, 'store'])->name('admin.attendance.store');
   // Route::get('/{id}/edit', [AttendanceController::class, 'edit'])->name('admin.attendance.edit');
   Route::get('/edit-session/{course_id}/{date}',[AttendanceController::class, 'editSession'])->name('admin.attendance.editSession');
    //Route::put('/{id}', [AttendanceController::class, 'update'])->name('admin.attendance.update');
    Route::put('/update-session',[AttendanceController::class, 'updateSession'])->name('admin.attendance.updateSession');
    Route::get('/{id}', [AttendanceController::class, 'destroy'])->name('admin.attendance.destroy');
    Route::get('/{id}/view', [AttendanceController::class, 'show'])->name('admin.attendance.view');


    });

    Route::prefix('exams')->group(function () {
    Route::get('/', [ExamController::class, 'index'])->name('admin.exams.index');
    Route::get('/create', [ExamController::class, 'create'])->name('admin.exams.create');
    Route::post('/store', [ExamController::class, 'store'])->name('admin.exams.store');
    Route::get('/{exam}/edit', [ExamController::class, 'edit'])->name('admin.exams.edit');
    Route::put('/{exam}', [ExamController::class, 'update'])->name('admin.exams.update');
    Route::get('/{exam}', [ExamController::class, 'destroy'])->name('admin.exams.destroy');
    Route::get('/{exam}/view', [ExamController::class, 'show'])->name('admin.exams.view');


    });

    Route::prefix('grades')->group(function () {
    Route::get('/',[GradeController::class, 'index'])->name('admin.grades.index');
    Route::get('/create', [GradeController::class, 'create'])->name('admin.grades.create');
    Route::post('/store', [GradeController::class, 'store'])->name('admin.grades.store');
    Route::get('/grades/students',[GradeController::class, 'getStudents'])->name('admin.grades.students');
    Route::post('/grades/store',[GradeController::class, 'store'])->name('admin.grades.store');
    Route::get('/{grade}/edit',[GradeController::class, 'edit'])->name('admin.grades.edit');
    Route::put('/{grade}',[GradeController::class, 'update'])->name('admin.grades.update');
    Route::get('/{grade}',[GradeController::class, 'destroy'])->name('admin.grades.destroy');
    });


    Route::prefix('quiz-bank')->group(function (){
    Route::get('/', [QuizQuestionController::class, 'index'])->name('admin.quiz-bank.index');
    Route::get('/create', [QuizQuestionController::class, 'create'])->name('admin.quiz-bank.create');
    Route::post('/store', [QuizQuestionController::class, 'store'])->name('admin.quiz-bank.store');
    Route::get('/{question}/edit', [QuizQuestionController::class, 'edit'])->name('admin.quiz-bank.edit');
    Route::put('/{question}', [QuizQuestionController::class, 'update'])->name('admin.quiz-bank.update');
    Route::delete('/{quizBank}',[QuizQuestionController::class, 'destroy'])->name('admin.quiz-bank.destroy');

     });


