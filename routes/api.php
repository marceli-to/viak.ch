<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\TranslationController;
use App\Http\Controllers\Api\StudentRegisterController;
use App\Http\Controllers\Api\GenderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::middleware('auth:sanctum')->group(function() {
  Route::get('user', [UserController::class, 'find']);
});

// Register
Route::post('/student/create', [StudentRegisterController::class, 'create']);

// Filter & Search
Route::get('/course/filters', [FilterController::class, 'settings']);
Route::post('/course/filter', [FilterController::class, 'filter']);
Route::post('/course/search', [FilterController::class, 'search']);
Route::delete('/course/filter', [FilterController::class, 'reset']);

// Translations
Route::get('/translations/{locale}', [TranslationController::class, 'fetch']);

// Genders
Route::get('/genders', [GenderController::class, 'fetch']);