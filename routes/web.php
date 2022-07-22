<?php
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RolesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [HomeController::class, 'index'])->name('page.home');
Route::get('/kontakt', [ContactController::class, 'index'])->name('page.contact');

Route::get('/kurse', [CourseController::class, 'list'])->name('page.courses');
Route::get('/kurs/{slug?}/{course:uuid}', [CourseController::class, 'show'])->name('page.course');

Route::get('/experten', [ExpertController::class, 'list'])->name('page.experts');
Route::get('/experte/{slug?}/{user:uuid}', [ExpertController::class, 'show'])->name('page.expert');
Route::get('/experte/profile', [ExpertController::class, 'profile'])->name('page.expert.profile')->middleware(['role:expert', 'verified']);


Route::get('/student/register', [StudentController::class, 'register'])->name('page.student.register');
Route::get('/student/profile', [StudentController::class, 'profile'])->name('page.student.profile')->middleware(['role:student', 'verified']);

Route::get('/checkout/basket', [CheckoutController::class, 'basket'])->name('page.checkout.basket');
Route::get('/checkout/address', [CheckoutController::class, 'address'])->name('page.checkout.user')->middleware(['role:student', 'verified']);

// Url based images
Route::get('/img/{template}/{filename}/{maxSize?}/{coords?}/{ratio?}', [ImageController::class, 'getResponse']);

// PDF Documents
Route::get('/pdf/kurs-bestaetigung', [DocumentController::class, 'attendanceConfirmation'])->name('pdf.student-attendance-confirmation');
Route::get('/pdf/kurs-uebersicht', [DocumentController::class, 'courseOverview'])->name('pdf.student-course-overview');
Route::get('/pdf/teilnehmer-liste', [DocumentController::class, 'participantsList'])->name('pdf.course-participants-list');
Route::get('/pdf/rechnung', [DocumentController::class, 'invoice'])->name('pdf.invoice');


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
*/

Auth::routes(['verify' => true, 'register' => true]);
Route::match(['get', 'post'], 'register', function(){
  return redirect()->route('page.student.register');
});
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/email/verify', function () {
  return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();
  return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


/*
|--------------------------------------------------------------------------
| Web Routes (protected)
|--------------------------------------------------------------------------
|
*/

// Protected routes
Route::middleware('auth:sanctum', 'verified')->group(function() {

  // Routes for user with multiple roles
  Route::get('/administration/roles', [RolesController::class, 'index'])->name('page.role.select');
  Route::get('/administration/role/{role:uuid}', [RolesController::class, 'set'])->name('page.role.set');

  // Routes for testing
  Route::get('/administration/test', [TestController::class, 'test'])->middleware(['role:admin,student,expert']);
  Route::get('/administration/notify', [TestController::class, 'notify'])->middleware(['role:admin,student,expert']);
  Route::get('/administration/notify/process', [TestController::class, 'process'])->middleware(['role:admin,student,expert']);
  Route::get('/administration/booked', [TestController::class, 'booked'])->middleware(['role:admin,student,expert']);

  Route::get('/administration/models', [TestController::class, 'models'])->middleware(['role:admin,student,expert']);
  Route::get('/administration/search', [TestController::class, 'search'])->middleware(['role:admin,student,expert']);

  Route::get('/administration/{any?}', function () {
    return view('web.layout.backend');
  })->where('any', '.*')->middleware(['role:admin']);
});


