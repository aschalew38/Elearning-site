<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('/course', CourseController::class);
    Route::resource('/instructors', InstructorController::class);
    Route::get('/course/{course}/activate', [
        CourseController::class,
        'activate',
    ])->name('course.activate');
    Route::get('/course/{course}/enroll', [
        CourseController::class,
        'enroll',
    ])->name('enroll');

    Route::get('/course/{course}/gotoclass', [
        CourseController::class,
        'gotoclass',
    ])->name('gotoclass');
    Route::get('/course/{course}/course_certificate', [
        CourseController::class,
        'certificate',
    ])->name('course_certificate');
    Route::get('/course/{course}/add_exam', [
        AssessmentController::class,
        'add_exam',
    ])->name('add_exam');
    Route::get('/course/{course}/add_test', [
        AssessmentController::class,
        'add_test',
    ])->name('add_test');
    Route::get('/course/{course}/user/{user}/certificate', [
        CourseController::class,
        'certificate',
    ])->name('certificate');

    Route::post('/updateVideo', [ClassController::class, 'updateVideo'])->name(
        'updateVideo'
    );
    Route::post('/Course/{course}/store_exam', [
        AssessmentController::class,
        'store_exam',
    ])->name('store_exam');
    Route::post('/Course/{course}/store_test', [
        AssessmentController::class,
        'store_test',
    ])->name('store_test');
    Route::get('/course/{course}/deactivate', [
        CourseController::class,
        'deactivate',
    ])->name('course.deactivate');
    Route::resource('course/{course}/sections', SectionController::class);
    Route::post('Assessment/{assessment}/submit_answer', [
        AssessmentController::class,
        'submit_answer',
    ])->name('submit_answer');
    Route::get('Assessment/{assessment}/show_result', [
        AssessmentController::class,
        'show_result',
    ])->name('show_result');
    Route::resource('section/{section}/resource', ResourceController::class);
    Route::resource(
        'course/{course}/section/{section}/resource/{resource}/exercise',
        ExerciseController::class
    );
    Route::resource(
        'resource/{resource?}/assessment',
        AssessmentController::class
    );
    Route::get('/assessment/{assessment}', [
        AssessmentController::class,
        'show',
    ])->name('final_exam');
    Route::get('/Course/{course}/like', [
        CourseController::class,
        'like',
    ])->name('course.like');
    Route::get('/Course/{course}/dislike', [
        CourseController::class,
        'dislike',
    ])->name('course.dislike');
    // Route::resource('/assessment', AssessmentController::class);
    Route::resource(
        'course/{course}/section/{section}/resources',
        ClassController::class
    );

});
