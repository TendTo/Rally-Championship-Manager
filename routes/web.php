<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\ChampionshipController;
use App\Http\Controllers\RallyController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\ResultController;

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

Route::get(
    '/', function () {
        return redirect('/championship');
    }
);

Route::get(
    '/about', function () {
        return view('about');
    }
);

/**
 * Auth routes
 */
Auth::routes();

//Route::get('/home', [HomeController::class, 'index'])->name('home');

/**
 * Championship routes
 */
Route::get('/championship/archived', [ChampionshipController::class, 'index_archived'])->name('championship.archived');
Route::get('championship/{championship}/result', [ChampionshipController::class, 'result'])->name('championship.result');
Route::resource('championship', ChampionshipController::class);

/**
 * Location routes
 */
Route::get('location', [LocationController::class, 'index'])->name('location.index');
Route::get('location/{id}', [LocationController::class, 'show'])->name('location.show');

/**
 * Rally routes
 */
Route::get('championship/{championship}/rally/{rally}/result', [RallyController::class, 'result'])->name('rally.result');
Route::resource('championship.rally', RallyController::class);

/**
 * User routes
 */
Route::get('user/{user}/championship', [UserController::class, 'championship']);
Route::resource('user', UserController::class);

/**
 * Car routes
 */
Route::resource('car', CarController::class);

/**
 * Participant routes
 */
Route::patch('championship/{championship}/participant/{participant}/upgrade', [ParticipantController::class, 'upgrade'])->name('participant.upgrade');
Route::patch('championship/{championship}/participant/{participant}/downgrade', [ParticipantController::class, 'downgrade'])->name('participant.downgrade');
Route::resource('championship.participant', ParticipantController::class);

/**
 * Stage routes
 */
Route::resource('championship.rally.stage', StageController::class);

/**
 * Result routes
 */
Route::resource('championship.rally.stage.result', ResultController::class);
