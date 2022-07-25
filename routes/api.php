<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\TranslationController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\StudentRegisterController;
use App\Http\Controllers\Api\ExpertController;
use App\Http\Controllers\Api\GenderController;
use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ImageController;

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

// Basket
Route::middleware(['auth:sanctum', 'verified', 'role:student'])->group(function() {
  Route::get('/basket', [BasketController::class, 'get']);
  Route::put('/basket/add/user', [BasketController::class, 'addUser']);
  Route::put('/basket/add/payment', [BasketController::class, 'addPayment']);
  Route::post('/booking', [BookingController::class, 'create']);
});

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

// Student (public)
Route::post('/student/register', [StudentRegisterController::class, 'create']);

// Student (authorized)
Route::middleware(['auth:sanctum', 'verified', 'role:student'])->group(function() {
  Route::get('/student/{map?}', [StudentController::class, 'find']);
  Route::put('/student', [StudentController::class, 'update']);
  Route::delete('/student', [StudentController::class, 'destroy']);
});

// Expert (authorized)
Route::middleware(['auth:sanctum', 'verified', 'role:expert'])->group(function() {
  Route::get('/expert', [ExpertController::class, 'find']);
  Route::put('/expert', [ExpertController::class, 'update']);
  Route::delete('/expert', [ExpertController::class, 'destroy']);
});

// Images
Route::middleware(['auth:sanctum', 'verified', 'role:admin,student,expert'])->group(function() {
  Route::get('images', [ImageController::class, 'get']);
  Route::post('images/order', [ImageController::class, 'order']);
  Route::get('image/{image}', [ImageController::class, 'find']);
  Route::post('image/upload', [ImageController::class, 'upload']);
  Route::post('image', [ImageController::class, 'store']);
  Route::put('image/coords/{image}', [ImageController::class, 'coords']);
  Route::put('image/{image}', [ImageController::class, 'update']);
  Route::get('image/state/{image}', [ImageController::class, 'toggle']);
  Route::delete('image/{image}', [ImageController::class, 'destroy']);
});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//   return $request->user();
// });

// Route::middleware('auth:sanctum')->group(function() {
//   Route::get('user', [UserController::class, 'find']);
// });
