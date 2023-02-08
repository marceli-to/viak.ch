<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\TranslationController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\StudentAddressController;
use App\Http\Controllers\Api\StudentRegisterController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ExpertController;
use App\Http\Controllers\Api\GenderController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\DiscountCodeController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\BookmarkController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\EventMessageController;
use App\Http\Controllers\Api\EventFileController;
use App\Http\Controllers\Api\NewsletterSubscriberController;
use App\Http\Controllers\Api\Dashboard\ExpertController as DashboardExpertController;
use App\Http\Controllers\Api\Dashboard\StudentController as DashboardStudentController;
use App\Http\Controllers\Api\Dashboard\CourseController as DashboardCourseController;
use App\Http\Controllers\Api\Dashboard\CourseVideoController as DashboardCourseVideoController;
use App\Http\Controllers\Api\Dashboard\CourseSettingsController as DashboardCourseSettingsController;
use App\Http\Controllers\Api\Dashboard\EventController as DashboardEventController;
use App\Http\Controllers\Api\Dashboard\EventSettingsController as DashboardEventSettingsController;
use App\Http\Controllers\Api\Dashboard\DiscountCodeController as DashboardDiscountCodeController;
use App\Http\Controllers\Api\Dashboard\Settings\CategoryController as DashboardCategoryController;
use App\Http\Controllers\Api\Dashboard\Settings\LanguageController as DashboardLanguageController;
use App\Http\Controllers\Api\Dashboard\Settings\LevelController as DashboardLevelController;
use App\Http\Controllers\Api\Dashboard\Settings\SoftwareController as DashboardSoftwareController;
use App\Http\Controllers\Api\Dashboard\Settings\TagController as DashboardTagController;
use App\Http\Controllers\Api\Dashboard\Settings\LocationController as DashboardLocationController;
use App\Http\Controllers\Api\Dashboard\TeamMemberController as DashboardTeamMemberController;
use App\Http\Controllers\Api\Dashboard\NewsController as DashboardNewsController;
use App\Http\Controllers\Api\Dashboard\HeroController as DashboardHeroController;
use App\Http\Controllers\Api\Dashboard\GridRowController as DashboardGridRowController;
use App\Http\Controllers\Api\Dashboard\GridRowItemController as DashboardGridRowItemController;
use App\Http\Controllers\Api\Dashboard\InvoiceController as DashboardInvoiceController;


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


/*
|--------------------------------------------------------------------------
| Basket, Discount
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'verified', 'role:student'])->group(function() {
  Route::get('/basket', [BasketController::class, 'get']);
  Route::get('/basket/summary', [BasketController::class, 'getSummary']);
  Route::put('/basket/add/user', [BasketController::class, 'addUser']);
  Route::put('/basket/add/payment-info', [BasketController::class, 'addPayment']);
  Route::get('/discount-code/check/{code}', [DiscountCodeController::class, 'check']);
});

Route::put('/basket/{event:uuid}', [BasketController::class, 'store']);
Route::delete('/basket/{event:uuid}', [BasketController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| Bookings, Bookmarks
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'verified', 'role:admin,expert,student'])->group(function() {
  Route::post('/booking', [BookingController::class, 'store'])->middleware(['role:student']);
  Route::post('/booking/participation', [BookingController::class, 'updateParticipation'])->middleware(['role:admin,expert']);
  Route::put('/booking/cancel/{booking:uuid}', [BookingController::class, 'cancel'])->middleware(['role:admin,student']);;
  Route::put('/bookmark/{event:uuid}', [BookmarkController::class, 'store'])->middleware(['role:student']);;
  Route::delete('/bookmark/{bookmark:uuid}', [BookmarkController::class, 'destroy'])->middleware(['role:student']);;
});


/*
|--------------------------------------------------------------------------
| Filter, Search, Translation, Genders
|--------------------------------------------------------------------------
*/

Route::get('/course/filters', [FilterController::class, 'settings']); // (@has testcase)
Route::post('/course/filter', [FilterController::class, 'filter']); // (@has testcase)
Route::post('/course/search', [FilterController::class, 'search']); // (@has testcase)
Route::delete('/course/filter', [FilterController::class, 'reset']); // (@has testcase)
Route::get('/translations/{locale}', [TranslationController::class, 'fetch']); // (@has testcase)
Route::get('/genders', [GenderController::class, 'get']); // (@has testcase)
Route::get('/countries', [CountryController::class, 'get']); // (@has testcase)
Route::get('/user/settings', [UserController::class, 'settings']); // (@has testcase)
Route::post('/newsletter/subscribe', [NewsletterSubscriberController::class, 'subscribe']);


/*
|--------------------------------------------------------------------------
| Student
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'verified', 'role:student'])->group(function() {
  Route::get('/student/profile', [StudentController::class, 'profile']);
  Route::get('/student/address/{userAddress:uuid}', [StudentAddressController::class, 'find']);
  Route::post('/student/address', [StudentAddressController::class, 'store']);
  Route::put('/student/address/{userAddress:uuid}', [StudentAddressController::class, 'update']);
  Route::delete('student/address/{userAddress:uuid}', [StudentAddressController::class, 'destroy']);
  Route::get('/student', [StudentController::class, 'find']);
  Route::get('/student/documents', [StudentController::class, 'getDocuments']);
  Route::put('/student', [StudentController::class, 'update']);
});
Route::post('/student/register', [StudentRegisterController::class, 'create']);


/*
|--------------------------------------------------------------------------
| Expert
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'verified', 'role:expert'])->group(function() {
  Route::get('/expert', [ExpertController::class, 'find']);
  Route::put('/expert', [ExpertController::class, 'update']);
});


/*
|--------------------------------------------------------------------------
| Administrator
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->group(function() {
  Route::get('/admin', [AdminController::class, 'find']);
  Route::put('/admin', [AdminController::class, 'update']);
});


/*
|--------------------------------------------------------------------------
| Courses, Events, Messages etc.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'verified', 'role:admin,expert,student'])->group(function() {
  Route::get('/event/messages/{event:uuid}', [EventMessageController::class, 'get']);
  Route::post('/event/message', [EventMessageController::class, 'store']);
  Route::post('/event/file', [EventFileController::class, 'store']);
  Route::get('/message/{message:uuid}', [EventMessageController::class, 'find']);
  Route::get('/expert/course/event/{event:uuid}', [EventController::class, 'findExpertEvent'])->middleware(['role:admin,expert']);
  Route::get('/student/course/event/{event:uuid}', [EventController::class, 'findStudentEvent'])->middleware(['role:admin,student']);
});


/*
|--------------------------------------------------------------------------
| Images  
|--------------------------------------------------------------------------
*/

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
| Files  
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'verified', 'role:admin,expert,student'])->group(function() {
  Route::get('files', [FileController::class, 'get']);
  Route::get('file/{file}', [FileController::class, 'find']);
});

Route::middleware(['auth:sanctum', 'verified', 'role:admin,expert'])->group(function() {
  Route::post('files/order', [FileController::class, 'order']);
  Route::post('file/upload', [FileController::class, 'upload']);
  Route::post('file', [FileController::class, 'store']);
  Route::put('file/{file:uuid}', [FileController::class, 'update']);
  Route::get('file/state/{file}', [FileController::class, 'toggle']);
  Route::delete('file/{file:uuid}', [FileController::class, 'destroy']);
});



/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
*/

// Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->get('/user', function (Request $request) {
//   return $request->user()->uuid;
// });

Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->prefix('dashboard')->group(function() {

  // Course settings
  Route::get('course-settings', [DashboardCourseSettingsController::class, 'get']);

  // Courses
  Route::get('courses/{constraint?}', [DashboardCourseController::class, 'get']);
  Route::get('course/{course}', [DashboardCourseController::class, 'find']);
  Route::post('course', [DashboardCourseController::class, 'store']);
  Route::put('course/{course}', [DashboardCourseController::class, 'update']);
  Route::get('course/state/{course}', [DashboardCourseController::class, 'toggle']);
  Route::post('course/order', [DashboardCourseController::class, 'order']);
  Route::delete('course/{course}', [DashboardCourseController::class, 'destroy']);

  // Course videos
  Route::get('course/videos/{course}', [DashboardCourseVideoController::class, 'get']);
  Route::get('course/video/{courseVideo}', [DashboardCourseVideoController::class, 'find']);
  Route::post('course/video/', [DashboardCourseVideoController::class, 'store']);
  Route::put('course/video/{courseVideo}', [DashboardCourseVideoController::class, 'update']);
  Route::get('course/video/state/{courseVideo}', [DashboardCourseVideoController::class, 'toggle']);
  Route::post('course/video/order', [DashboardCourseVideoController::class, 'order']);
  Route::delete('course/video/{courseVideo}', [DashboardCourseVideoController::class, 'destroy']);

  // Event settings
  Route::get('event-settings', [DashboardEventSettingsController::class, 'get']);

  // Events
  Route::get('events/{course:uuid}', [DashboardEventController::class, 'get']);
  Route::get('event/{event:uuid}', [DashboardEventController::class, 'find']);
  Route::post('event', [DashboardEventController::class, 'store']);
  Route::put('event/confirm/{event:uuid}', [DashboardEventController::class, 'confirm']);
  Route::put('event/cancel/{event:uuid}', [DashboardEventController::class, 'cancel']);
  Route::put('event/close/{event:uuid}', [DashboardEventController::class, 'close']);
  Route::put('event/{event:uuid}', [DashboardEventController::class, 'update']);
  Route::get('event/state/{event}', [DashboardEventController::class, 'toggle']);
  Route::delete('event/{event}', [DashboardEventController::class, 'destroy']);

  // Backoffice Invoices
  Route::get('invoices', [DashboardInvoiceController::class, 'get']);

  // Students
  Route::get('student/documents/{user}', [DashboardStudentController::class, 'getDocuments']);
  Route::get('students/{constraint?}', [DashboardStudentController::class, 'get']);
  Route::get('students/search/{keyword}', [DashboardStudentController::class, 'search']);
  Route::get('student/{user}', [DashboardStudentController::class, 'find']);
  Route::post('student', [DashboardStudentController::class, 'store']);
  Route::put('student/{user}', [DashboardStudentController::class, 'update']);
  Route::get('student/state/{user}', [DashboardStudentController::class, 'toggle']);
  Route::delete('student/{user}', [DashboardStudentController::class, 'destroy']);

  // Experts
  Route::get('experts', [DashboardExpertController::class, 'get']);
  Route::get('experts/search/{keyword}', [DashboardExpertController::class, 'search']);
  Route::get('expert/{user}', [DashboardExpertController::class, 'find']);
  Route::post('expert', [DashboardExpertController::class, 'store']);
  Route::put('expert/{user}', [DashboardExpertController::class, 'update']);
  Route::post('expert/order', [DashboardExpertController::class, 'order']);
  Route::get('expert/state/{user}', [DashboardExpertController::class, 'toggle']);
  Route::delete('expert/{user}', [DashboardExpertController::class, 'destroy']);

  // DiscountCodes (@has testcase)
  Route::get('discount-codes', [DashboardDiscountCodeController::class, 'get']);
  Route::get('discount-code/create', [DashboardDiscountCodeController::class, 'create']);
  Route::get('discount-code/{discountCode}', [DashboardDiscountCodeController::class, 'find']);
  Route::post('discount-code', [DashboardDiscountCodeController::class, 'store']);
  Route::put('discount-code/{discountCode}', [DashboardDiscountCodeController::class, 'update']);
  Route::delete('discount-code/{discountCode}', [DashboardDiscountCodeController::class, 'destroy']);

  // Team member (@has testcase)
  Route::get('team-members', [DashboardTeamMemberController::class, 'get']);
  Route::get('team-member/{teamMember}', [DashboardTeamMemberController::class, 'find']);
  Route::post('team-member', [DashboardTeamMemberController::class, 'store']);
  Route::put('team-member/{teamMember}', [DashboardTeamMemberController::class, 'update']);
  Route::post('team-members/order', [DashboardTeamMemberController::class, 'order']);
  Route::delete('team-member/{teamMember}', [DashboardTeamMemberController::class, 'destroy']);

  // News (@has testcase)
  Route::get('news-items', [DashboardNewsController::class, 'get']);
  Route::get('news/{news}', [DashboardNewsController::class, 'find']);
  Route::post('news', [DashboardNewsController::class, 'store']);
  Route::put('news/{news}', [DashboardNewsController::class, 'update']);
  Route::post('news/order', [DashboardNewsController::class, 'order']);
  Route::delete('news/{news}', [DashboardNewsController::class, 'destroy']);

  // Heroes (@has testcase)
  Route::get('heroes', [DashboardHeroController::class, 'get']);
  Route::get('hero/{hero}', [DashboardHeroController::class, 'find']);
  Route::post('hero', [DashboardHeroController::class, 'store']);
  Route::put('hero/{hero}', [DashboardHeroController::class, 'update']);
  Route::delete('hero/{hero}', [DashboardHeroController::class, 'destroy']);

  // Grid rows
  Route::get('grid/rows', [DashboardGridRowController::class, 'get']);
  Route::post('grid/row', [DashboardGridRowController::class, 'store']);
  Route::delete('grid/row/{gridRow}', [DashboardGridRowController::class, 'destroy']);
  Route::post('grid/item/order', [DashboardGridRowController::class, 'order']);

  // Grid row items
  Route::get('grid/row/item/reset/{gridRowItem}', [DashboardGridRowItemController::class, 'reset']);
  Route::put('grid/row/item/add/news/{gridRowItem}', [DashboardGridRowItemController::class, 'addNews']);
  Route::put('grid/row/item/add/course/{gridRowItem}', [DashboardGridRowItemController::class, 'addCourse']);
  Route::put('grid/row/item/add/code/{gridRowItem}', [DashboardGridRowItemController::class, 'addCode']);
  Route::get('grid/row/item/get/code/{gridRowItem}', [DashboardGridRowItemController::class, 'getCode']);

  // Settings
  Route::prefix('settings')->group(function() {

    // Categories (@has testcase)
    Route::get('categories', [DashboardCategoryController::class, 'get']);
    Route::get('category/{category}', [DashboardCategoryController::class, 'find']);
    Route::post('category', [DashboardCategoryController::class, 'store']);
    Route::put('category/{category}', [DashboardCategoryController::class, 'update']);
    Route::delete('category/{category}', [DashboardCategoryController::class, 'destroy']);

    // Languages (@has testcase)
    Route::get('languages', [DashboardLanguageController::class, 'get']);
    Route::get('language/{language}', [DashboardLanguageController::class, 'find']);
    Route::post('language', [DashboardLanguageController::class, 'store']);
    Route::put('language/{language}', [DashboardLanguageController::class, 'update']);
    Route::delete('language/{language}', [DashboardLanguageController::class, 'destroy']);

    // Level (@has testcase)
    Route::get('levels', [DashboardLevelController::class, 'get']);
    Route::get('level/{level}', [DashboardLevelController::class, 'find']);
    Route::post('level', [DashboardLevelController::class, 'store']);
    Route::put('level/{level}', [DashboardLevelController::class, 'update']);
    Route::delete('level/{level}', [DashboardLevelController::class, 'destroy']);

    // Software (@has testcase)
    Route::get('softwares', [DashboardSoftwareController::class, 'get']);
    Route::get('software/{software}', [DashboardSoftwareController::class, 'find']);
    Route::post('software', [DashboardSoftwareController::class, 'store']);
    Route::put('software/{software}', [DashboardSoftwareController::class, 'update']);
    Route::delete('software/{software}', [DashboardSoftwareController::class, 'destroy']);

    // Tag (@has testcase)
    Route::controller(DashboardTagController::class)->group(function () {
      Route::get('tags', 'get');
      Route::get('tag/{tag}', 'find');
      Route::post('tag', 'store');
      Route::put('tag/{tag}', 'update');
      Route::delete('tag/{tag}', 'destroy');    
    });

    // Location (@has testcase)
    Route::controller(DashboardLocationController::class)->group(function () {
      Route::get('locations', 'get');
      Route::get('location/{location}', 'find');
      Route::post('location', 'store');
      Route::put('location/{location}', 'update');
      Route::delete('location/{location}', 'destroy');
    });

  }); //-- Settings

});

