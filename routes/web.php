<?php
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RolesController;
use App\Http\Controllers\Auth\ConfirmExpertController;
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
Route::get('/student/register', [StudentController::class, 'register'])->name('page.student.register');

// Url based images
Route::get('/img/{template}/{filename}/{maxSize?}/{coords?}/{ratio?}', [ImageController::class, 'getResponse']);


/*
|--------------------------------------------------------------------------
| Web Routes (protected)
|--------------------------------------------------------------------------
|
*/

// Protected routes
Route::middleware('auth:sanctum', 'verified')->group(function() {

  Route::get('/experte/profile', [ExpertController::class, 'profile'])->name('page.expert.profile')->middleware(['role:expert']);
  Route::get('/student/profile', [StudentController::class, 'profile'])->name('page.student.profile')->middleware(['role:student']);

  Route::get('/checkout/basket', [CheckoutController::class, 'index'])->name('page.checkout.basket')->middleware(['role:student']);
  Route::get('/checkout/confirmation', [CheckoutController::class, 'confirmation'])->name('page.checkout.confirmation');
  Route::get('/checkout/{any?}', [CheckoutController::class, 'index'])->middleware(['role:student']);

  // Routes for user with multiple roles
  Route::get('/roles', [RolesController::class, 'index'])->name('page.role.select');
  Route::get('/role/{role:uuid}', [RolesController::class, 'set'])->name('page.role.set');

  // Routes for dashboard
  Route::get('/dashboard/{any?}', function () {
    return view('web.layout.backend');
  })->where('any', '.*')->middleware(['role:admin'])->name('page.dashboard');
});


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

Route::get('/email/confirm/{id}/{token}', function (Request $request, $id, $token) {
  return redirect()->route('auth.expert.confirm', ['token' => $token]);
})->name('verification.confirm');

Route::get('/email/bestaetigen/{token}', [ConfirmExpertController::class, 'confirm'])->name('auth.expert.confirm');
Route::post('/expert/finish', [ConfirmExpertController::class, 'store'])->name('auth.expert.finish');


/*
|--------------------------------------------------------------------------
| Test routes
|--------------------------------------------------------------------------
|
*/

Route::get('/notification', [TestController::class, 'notify']);
Route::get('/notification/process', [TestController::class, 'process']);
Route::get('/notification/booked', [TestController::class, 'booked']);
Route::get('/mailable', function () {
  $event = \App\Models\Event::with('course')->first();
  return new App\Mail\EventBooked($event);
});


// PDF Documents
Route::get('/dokumente', [DocumentController::class, 'index'])->name('documents.index');

Route::get('/pdf/kurs-bestaetigung', [DocumentController::class, 'attendanceConfirmation'])->name('pdf.student-attendance-confirmation');
Route::get('/pdf/kurs-uebersicht', [DocumentController::class, 'courseOverview'])->name('pdf.student-course-overview');
Route::get('/pdf/teilnehmer-liste', [DocumentController::class, 'participantsList'])->name('pdf.course-participants-list');
Route::get('/pdf/rechnung', [DocumentController::class, 'invoice'])->name('pdf.invoice');
