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
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\TestController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [HomeController::class, 'index'])->name('de.page.home');
Route::get('/de', [HomeController::class, 'index'])->name('de.page.home');
Route::get('/en', [HomeController::class, 'index'])->name('en.page.home');

Route::multilingual('kontakt', [ContactController::class, 'index'])->names(['de' => 'page.contact', 'en' => 'page.contact']);

Route::multilingual('kurse', [CourseController::class, 'list'])->names(['de' => 'page.courses', 'en' => 'page.courses']);
Route::get('de/kurs/{slug?}/{course:uuid}', [CourseController::class, 'show'])->name('de.page.course');
Route::get('en/course/{slug?}/{course:uuid}', [CourseController::class, 'show'])->name('en.page.course');

Route::multilingual('experten', [ExpertController::class, 'list'])->names(['de' => 'page.experts', 'en' => 'page.experts']);
Route::get('de/experte/{slug?}/{user:uuid}', [ExpertController::class, 'show'])->name('de.page.expert');
Route::get('en/expert/{slug?}/{user:uuid}', [ExpertController::class, 'show'])->name('en.page.expert');

Route::get('/student/register', [RegisterController::class, 'register'])->name('page.register.form');

// URL based images
Route::get('/img/{template}/{filename}/{maxSize?}/{coords?}/{ratio?}', [ImageController::class, 'getResponse']);

/*
|--------------------------------------------------------------------------
| Web Routes (protected)
|--------------------------------------------------------------------------
|
*/

// Protected routes
Route::middleware('auth:sanctum', 'verified')->group(function() {

  // Expert
  Route::view(
    '/expert/profile/course/event/{uuid}', 
    'web.pages.user.expert.index'
  )->name('page.expert.profile.course.event')->middleware(['role:admin,expert']);

  Route::view(
    '/expert/profile/{any?}',
    'web.pages.user.expert.index'
  )->name('page.expert.profile')->where('any', '.*')->middleware(['role:expert']);

  // Student
  Route::view(
    '/student/profile/course/event/{uuid}',
    'web.pages.user.student.index'
  )->name('page.student.profile.course.event')->middleware(['role:student']);

  Route::view(
    '/student/profile/{any?}',
    'web.pages.user.student.index'
  )->name('page.student.profile')->where('any', '.*')->middleware(['role:student']);

  

  Route::middleware(['role:student'])->group(function() {
    Route::get('de/checkout/basket', [CheckoutController::class, 'index'])->name('de.page.checkout.basket');
    Route::get('en/checkout/basket', [CheckoutController::class, 'index'])->name('en.page.checkout.basket');

    Route::get('de/checkout/user', [CheckoutController::class, 'index'])->name('de.page.checkout.user');
    Route::get('en/checkout/user', [CheckoutController::class, 'index'])->name('en.page.checkout.user');

    Route::get('de/checkout/payment', [CheckoutController::class, 'index'])->name('de.page.checkout.payment');
    Route::get('en/checkout/payment', [CheckoutController::class, 'index'])->name('en.page.checkout.payment');

    Route::get('de/checkout/summary', [CheckoutController::class, 'index'])->name('de.page.checkout.summary');
    Route::get('en/checkout/summary', [CheckoutController::class, 'index'])->name('en.page.checkout.summary');

    Route::get('de/checkout/confirmation', [CheckoutController::class, 'confirmation'])->name('de.page.checkout.confirmation');
    Route::get('en/checkout/confirmation', [CheckoutController::class, 'confirmation'])->name('en.page.checkout.confirmation');

    Route::get('de/checkout/{any?}', [CheckoutController::class, 'index']);
    Route::get('en/checkout/{any?}', [CheckoutController::class, 'index']);

    Route::post('/payment/checkout/session', [PaymentController::class, 'create'])->name('page.payment.checkout.session');

    Route::get('/de/zahlung/rechnung/{invoice:uuid}', [PaymentController::class, 'index'])->name('de.page.payment.overview');
    Route::get('/en/payment/invoice/{invoice:uuid}', [PaymentController::class, 'index'])->name('en.page.payment.overview');

    Route::get('/de/zahlung/erfolgreich', [PaymentController::class, 'success'])->name('de.page.payment.success');
    Route::get('/en/payment/success', [PaymentController::class, 'success'])->name('en.page.payment.success');

    Route::get('/de/zahlung/abbrechen', [PaymentController::class, 'cancel'])->name('de.page.payment.cancel');
    Route::get('/en/payment/cancel', [PaymentController::class, 'cancel'])->name('en.page.payment.cancel');

  });


  // Routes for user with multiple roles
  Route::get('/roles', [RolesController::class, 'index'])->name('page.role.select')->middleware(['role:admin']);
  Route::get('/role/{role:uuid}', [RolesController::class, 'set'])->name('page.role.set')->middleware(['role:admin']);
  
  // Dashboard routes
  Route::get('/dashboard/{any?}', function () {
    return view('web.layout.backend');
  })->where('any', '.*')->middleware(['role:admin'])->name('page.dashboard');

  // Documents
  Route::get('/pdf/teilnehmer-liste/{event:uuid}', [DocumentController::class, 'participantsList'])->name('pdf.course-participants-list')->middleware(['role:admin,expert']);

});


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
*/

Auth::routes(['verify' => true, 'register' => true]);
Route::match(['get', 'post'], 'register', function(){
  return redirect()->route('page.register.form');
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

Route::get('/419', function() {
  abort(419);
});

Route::get('/test', [TestController::class, 'index']);

Route::get('/participant-changes', [TestController::class, 'participantChanges']);


Route::get('/message', [TestController::class, 'index']);

Route::get('/notification', [TestController::class, 'notify']);
Route::get('/notification/process', [TestController::class, 'process']);
Route::get('/notification/booked', [TestController::class, 'booked']);


// PDF Documents
Route::get('/dokumente', [DocumentController::class, 'index'])->name('documents.index');

Route::get('/pdf/kurs-bestaetigung', [DocumentController::class, 'attendanceConfirmation'])->name('pdf.student-attendance-confirmation');
Route::get('/pdf/kurs-uebersicht', [DocumentController::class, 'courseOverview'])->name('pdf.student-course-overview');
Route::get('/pdf/rechnung', [DocumentController::class, 'invoice'])->name('pdf.invoice');
