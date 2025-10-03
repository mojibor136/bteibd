<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Branch\BranchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BranchManageController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\PricingController;
use Illuminate\Support\Facades\Route;

// =======================
// Public/Home Routes
// =======================
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/course', 'course')->name('course');
    Route::get('/branch', 'branch')->name('branch');
    Route::get('/result', 'result')->name('result');
});

// =======================
// Admin Routes
// =======================
Route::prefix('admin')->name('admin.')->group(function () {

    // Authentication
    Route::controller(AdminController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login/submit', 'login')->name('login.submit');
        Route::get('/logout', 'logout')->name('logout');
    });

    // Protected routes
    Route::middleware(['admin'])->group(function () {

        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::get('/account', 'account')->name('account');
            Route::get('/settings/general', 'general')->name('settings.general');
        });

        // Branch CRUD
        Route::controller(BranchManageController::class)->group(function () {
            Route::get('/branches', 'index')->name('branches.index');
            Route::get('/branches/create', 'create')->name('branches.create');
            Route::post('/branches', 'store')->name('branches.store');
            Route::get('/branches/{id}/edit', 'edit')->name('branches.edit');
            Route::post('/branches/{id}', 'update')->name('branches.update');
            Route::delete('/branches/{id}', 'destroy')->name('branches.delete');
        });

        // Students
        Route::controller(StudentController::class)->group(function () {
            Route::get('/students', 'index')->name('students.index');
            Route::get('/students/create', 'create')->name('students.create');
            Route::post('/students', 'store')->name('students.store');
            Route::get('/students/{id}/edit', 'edit')->name('students.edit');
            Route::put('/students/{id}', 'update')->name('students.update');
            Route::delete('/students/{id}', 'destroy')->name('students.delete');

            // Reports
            Route::get('/reports/students', 'reportsStudents')->name('reports.students');
            Route::get('/reports/cgpa', 'reportsCgpa')->name('reports.cgpa');
            Route::get('/reports/enrollment', 'reportsEnrollment')->name('reports.enrollment');
        });

        // Semester CRUD
        Route::controller(SemesterController::class)->group(function () {
            Route::get('/semesters', 'index')->name('semesters.index');
            Route::get('/semesters/create', 'create')->name('semesters.create');
            Route::post('/semesters', 'store')->name('semesters.store');
            Route::get('/semesters/{id}/edit', 'edit')->name('semesters.edit');
            Route::put('/semesters/{id}', 'update')->name('semesters.update');
            Route::delete('/semesters/{id}', 'destroy')->name('semesters.delete');
            Route::get('/student/semesters', 'studentSemester')->name('student.semesters.index');
            Route::get('/student/semesters/create', 'studentSemesterCreate')->name('student.semesters.create');
        });

        // Course CRUD
        Route::controller(CourseController::class)->group(function () {
            Route::get('/courses', 'index')->name('courses.index');
            Route::get('/courses/create', 'create')->name('courses.create');
            Route::post('/courses', 'store')->name('courses.store');
            Route::get('/courses/{id}/edit', 'edit')->name('courses.edit');
            Route::put('/courses/{id}', 'update')->name('courses.update');
            Route::delete('/courses/{id}', 'destroy')->name('courses.delete');
            Route::get('/student/courses', 'studentCourses')->name('student.courses.index');
            Route::get('/student/courses/create', 'studentCoursesCreate')->name('student.courses.create');
        });

        // Pricing CRUD
        Route::controller(PricingController::class)->group(function () {
            Route::get('/pricing', 'index')->name('pricing.index');
            Route::get('/pricing/create', 'create')->name('pricing.create');
            Route::post('/pricing', 'store')->name('pricing.store');
            Route::get('/pricing/{id}/edit', 'edit')->name('pricing.edit');
            Route::put('/pricing/{id}', 'update')->name('pricing.update');
            Route::delete('/pricing/{id}', 'destroy')->name('pricing.delete');
        });
    });
});

// =======================
// Branch Routes
// =======================
Route::prefix('branch')->name('branch.')->group(function () {
    Route::controller(BranchController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login/submit', 'login')->name('login.submit');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/register', 'showRegisterForm')->name('register');
        Route::post('/register', 'register')->name('register.submit');

        Route::middleware('auth')->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::get('/students', 'index')->name('students.index');
            Route::get('/students/pending', 'pending')->name('students.pending');
            Route::get('/students/approved', 'approved')->name('students.approved');
            Route::get('/students/create', 'create')->name('students.create');
            Route::post('/students', 'store')->name('students.store');
            Route::get('/students/{id}/edit', 'edit')->name('students.edit');
            Route::put('/students/{id}', 'update')->name('students.update');
            Route::get('/account', 'account')->name('account');
            Route::get('/pricing', 'pricing')->name('pricing');
        });
    });
});

require __DIR__ . '/auth.php';
