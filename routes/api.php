<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\TranslationController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\StudentRegisterController;
use App\Http\Controllers\Api\GenderController;
use App\Http\Controllers\Api\BasketController;



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

// Student
Route::get('/student', [StudentController::class, 'find']);
Route::put('/student', [StudentController::class, 'update']);
Route::delete('/student', [StudentController::class, 'destroy']);
Route::post('/student/register', [StudentRegisterController::class, 'create']);

// Basket
Route::get('/basket', [BasketController::class, 'get']);
Route::put('/basket/{event:uuid}', [BasketController::class, 'store']);
Route::delete('/basket/{event:uuid}', [BasketController::class, 'destroy']);


// Filter & Search
Route::get('/course/filters', [FilterController::class, 'settings']);
Route::post('/course/filter', [FilterController::class, 'filter']);
Route::post('/course/search', [FilterController::class, 'search']);
Route::delete('/course/filter', [FilterController::class, 'reset']);

// Translations
Route::get('/translations/{locale}', [TranslationController::class, 'fetch']);

// Genders
Route::get('/genders', [GenderController::class, 'fetch']);