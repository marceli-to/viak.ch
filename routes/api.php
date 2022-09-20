<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\TranslationController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\StudentRegisterController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ExpertController;
use App\Http\Controllers\Api\GenderController;
use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\BookmarkController;
use App\Http\Controllers\Api\ImageController;

use App\Http\Controllers\Api\Dashboard\ExpertController as DashboardExpertController;
use App\Http\Controllers\Api\Dashboard\StudentController as DashboardStudentController;
use App\Http\Controllers\Api\Dashboard\CourseController as DashboardCourseController;
use App\Http\Controllers\Api\Dashboard\CourseSettingsController as DashboardCourseSettingsController;
use App\Http\Controllers\Api\Dashboard\EventController as DashboardEventController;
use App\Http\Controllers\Api\Dashboard\EventSettingsController as DashboardEventSettingsController;
use App\Http\Controllers\Api\Dashboard\Settings\CategoryController as DashboardCategoryController;
use App\Http\Controllers\Api\Dashboard\Settings\LanguageController as DashboardLanguageController;
use App\Http\Controllers\Api\Dashboard\Settings\LevelController as DashboardLevelController;
use App\Http\Controllers\Api\Dashboard\Settings\SoftwareController as DashboardSoftwareController;
use App\Http\Controllers\Api\Dashboard\Settings\TagController as DashboardTagController;



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

// Basket (authorized)
Route::middleware(['auth:sanctum', 'verified', 'role:student'])->group(function() {
  Route::get('/basket', [BasketController::class, 'get']);
  Route::put('/basket/add/user', [BasketController::class, 'addUser']);
  Route::put('/basket/add/payment', [BasketController::class, 'addPayment']);
});

// Basket (public)
Route::put('/basket/{event:uuid}', [BasketController::class, 'store']);
Route::delete('/basket/{event:uuid}', [BasketController::class, 'destroy']);

// Bookings, Bookmarks
Route::middleware(['auth:sanctum', 'verified', 'role:student'])->group(function() {
  Route::post('/booking', [BookingController::class, 'store']);
  Route::put('/booking/cancel/{booking:uuid}', [BookingController::class, 'cancel']);
  Route::put('/bookmark/{event:uuid}', [BookmarkController::class, 'store']);
  Route::delete('/bookmark/{event:uuid}', [BookmarkController::class, 'destroy']);
});


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
Route::middleware(['auth:sanctum', 'verified', 'role:admin,student'])->group(function() {
  Route::get('/student/{map?}', [StudentController::class, 'find']);
  Route::put('/student', [StudentController::class, 'update']);
  Route::delete('/student', [StudentController::class, 'destroy']);
});

// Expert (authorized)
Route::middleware(['auth:sanctum', 'verified', 'role:admin,expert'])->group(function() {
  Route::get('/expert', [ExpertController::class, 'find']);
  Route::put('/expert', [ExpertController::class, 'update']);
  Route::delete('/expert', [ExpertController::class, 'destroy']);
});

// Admin (authorized)
Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->group(function() {
  Route::get('/admin', [AdminController::class, 'find']);
  Route::put('/admin', [AdminController::class, 'update']);
});

// Images
Route::middleware(['auth:sanctum', 'verified', 'role:admin,expert'])->group(function() {
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


/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->get('/user', function (Request $request) {
  return $request->user();
});

Route::middleware(['auth:sanctum', 'verified', 'role:admin,expert'])->prefix('dashboard')->group(function() {

  // Course settings
  Route::get('course-settings', [DashboardCourseSettingsController::class, 'get']);

  // Courses
  Route::get('courses/{constraint?}', [DashboardCourseController::class, 'get']);
  Route::get('course/{course}', [DashboardCourseController::class, 'find']);
  Route::post('course', [DashboardCourseController::class, 'store']);
  Route::put('course/{course}', [DashboardCourseController::class, 'update']);
  Route::get('course/state/{course}', [DashboardCourseController::class, 'toggle']);
  Route::delete('course/{course}', [DashboardCourseController::class, 'destroy']);

  // Event settings
  Route::get('event-settings', [DashboardEventSettingsController::class, 'get']);

  // Events
  Route::get('events/{constraint?}', [DashboardEventController::class, 'get']);
  Route::get('event/{event}', [DashboardEventController::class, 'find']);
  Route::post('event', [DashboardEventController::class, 'store']);
  Route::put('event/{event}', [DashboardEventController::class, 'update']);
  Route::get('event/state/{event}', [DashboardEventController::class, 'toggle']);
  Route::delete('event/{event}', [DashboardEventController::class, 'destroy']);

  // Students
  Route::get('students/{constraint?}', [DashboardStudentController::class, 'get']);
  Route::get('student/{user}', [DashboardStudentController::class, 'find']);
  Route::post('student', [DashboardStudentController::class, 'store']);
  Route::put('student/{user}', [DashboardStudentController::class, 'update']);
  Route::get('student/state/{user}', [DashboardStudentController::class, 'toggle']);
  Route::delete('student/{user}', [DashboardStudentController::class, 'destroy']);

  // Experts
  Route::get('experts', [DashboardExpertController::class, 'get']);
  Route::get('expert/{user}', [DashboardExpertController::class, 'find']);
  Route::post('expert', [DashboardExpertController::class, 'store']);
  Route::put('expert/{user}', [DashboardExpertController::class, 'update']);
  Route::get('expert/state/{user}', [DashboardExpertController::class, 'toggle']);
  Route::delete('expert/{user}', [DashboardExpertController::class, 'destroy']);

  // Settings
  Route::prefix('settings')->group(function() {

    // Categories
    Route::get('categories', [DashboardCategoryController::class, 'get']);
    Route::get('category/{category}', [DashboardCategoryController::class, 'find']);
    Route::post('category', [DashboardCategoryController::class, 'store']);
    Route::put('category/{category}', [DashboardCategoryController::class, 'update']);
    Route::delete('category/{category}', [DashboardCategoryController::class, 'destroy']);

    // Languages
    Route::get('languages', [DashboardLanguageController::class, 'get']);
    Route::get('language/{language}', [DashboardLanguageController::class, 'find']);
    Route::post('language', [DashboardLanguageController::class, 'store']);
    Route::put('language/{language}', [DashboardLanguageController::class, 'update']);
    Route::delete('language/{language}', [DashboardLanguageController::class, 'destroy']);

    // Level
    Route::get('levels', [DashboardLevelController::class, 'get']);
    Route::get('level/{level}', [DashboardLevelController::class, 'find']);
    Route::post('level', [DashboardLevelController::class, 'store']);
    Route::put('level/{level}', [DashboardLevelController::class, 'update']);
    Route::delete('level/{level}', [DashboardLevelController::class, 'destroy']);

    // Software
    Route::get('softwares', [DashboardSoftwareController::class, 'get']);
    Route::get('software/{software}', [DashboardSoftwareController::class, 'find']);
    Route::post('software', [DashboardSoftwareController::class, 'store']);
    Route::put('software/{software}', [DashboardSoftwareController::class, 'update']);
    Route::delete('software/{software}', [DashboardSoftwareController::class, 'destroy']);

    // Tag
    Route::get('tags', [DashboardTagController::class, 'get']);
    Route::get('tag/{tag}', [DashboardTagController::class, 'find']);
    Route::post('tag', [DashboardTagController::class, 'store']);
    Route::put('tag/{tag}', [DashboardTagController::class, 'update']);
    Route::delete('tag/{tag}', [DashboardTagController::class, 'destroy']);
  });

});

