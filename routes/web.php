<?php

use App\Http\Controllers\Student;
use App\Http\Controllers\Teacher;
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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {



    //group for all student role specific route
    Route::middleware('role:1')
        ->prefix('student')
        ->name('student.')
        ->group(function () {
            Route::get('timetable', [\Student\TimetableController::class, 'index'])
                ->name('timetable');

        }
        );
    Route::middleware('role:2')
        ->prefix('teacher')
        ->name('teacher.')
        ->group(function () {
            Route::get('timetable', [App\Http\Controllers\Teacher\TimetableController::class, 'index'])
                ->name('timetable');

        }
        );
    Route::middleware('role:3')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('timetable', [App\Http\Controllers\Admin\TimetableController::class, 'index'])
                ->name('timetable');

        }
        );
});




require __DIR__ . '/auth.php';