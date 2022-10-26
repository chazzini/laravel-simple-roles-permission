<?php

use App\Http\Controllers\Student\TimetableController;
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

    //route not specific to a role
    Route::get('/dashboard', function () {
        return view('dashboard');
    }
    )->name('dashboard');

    //group for all student role specific route
    Route::prefix('student')
        ->name('student.')
        ->group(function () {
            Route::get('timetable', [TimetableController::class, 'index'])
                ->name('timetable');

        }
        );
});




require __DIR__ . '/auth.php';
