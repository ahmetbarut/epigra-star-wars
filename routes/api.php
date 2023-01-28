<?php

use App\Http\Controllers\People\PeopleController;
use App\Http\Controllers\Species\SpeciesController;
use App\Http\Controllers\Vehicle\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('people')->group(
        function () {
            Route::get('/', [PeopleController::class, 'index']);
            Route::get('/{people}', [PeopleController::class, 'show']);
        }
    );

    Route::prefix('vehicles')->group(
        function () {
            Route::get('/', [VehicleController::class, 'index']);
            Route::get('/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
        }
    );

    Route::prefix('species')->group(
        function () {
            Route::get('/', [SpeciesController::class, 'index'])->name('species.index');
            Route::get('/{species}', [SpeciesController::class, 'show'])->name('species.show');
        }
    );
});
