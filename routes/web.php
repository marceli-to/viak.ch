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
use App\Http\Controllers\IndividualTrainingController;
use App\Http\Controllers\TestController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

// Route::get('/en/{any?}')->middleware(['role:admin']); // remove ROUTE if multilanguage for all users
Route::get('/maintenance', [HomeController::class, 'maintenance']);

Route::get('/', [HomeController::class, 'index'])->name('de.page.home');
Route::get('/de', [HomeController::class, 'index'])->name('de.page.home');
Route::get('/en', [HomeController::class, 'index'])->name('en.page.home')->middleware(['role:admin']); // remove MIDDLEWARE if multilanguage for all users

Route::multilingual('kontakt', [ContactController::class, 'index'])->name('page.contact');
Route::multilingual('kurse', [CourseController::class, 'list'])->name('page.courses');
Route::multilingual('individualschulungen', [IndividualTrainingController::class, 'index'])->name('page.individual-training');

Route::get('de/kurs/{slug?}/{course:uuid}', [CourseController::class, 'show'])->name('de.page.course');
Route::get('en/course/{slug?}/{course:uuid}', [CourseController::class, 'show'])->name('en.page.course')->middleware(['role:admin']); // remove MIDDLEWARE if multilanguage for all users

Route::multilingual('experten', [ExpertController::class, 'list'])->name('page.experts');
Route::get('de/experte/{slug?}/{user:uuid}', [ExpertController::class, 'show'])->name('de.page.expert');
Route::get('en/expert/{slug?}/{user:uuid}', [ExpertController::class, 'show'])->name('en.page.expert')->middleware(['role:admin']); // remove MIDDLEWARE if multilanguage for all users

Route::get('de/registration', [RegisterController::class, 'register'])->name('de.page.register.form');
Route::get('en/register', [RegisterController::class, 'register'])->name('en.page.register.form')->middleware(['role:admin']); // remove MIDDLEWARE if multilanguage for all users

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

  // Expert - Course
  Route::get('de/experte/profil/kurs/veranstaltung/{uuid}', function () {
    return view('web.pages.user.expert.index');
  })->where('any', '.*')->middleware(['role:admin,expert'])->name('de.page.expert.profile.course.event');
  Route::get('en/expert/profile/course/event/{uuid}', function () {
    return view('web.pages.user.expert.index');
  })->where('any', '.*')->middleware(['role:admin,expert'])->name('en.page.expert.profile.course.event');

  // Expert - Profile
  Route::get('de/experte/profil/{any?}', function () {
    return view('web.pages.user.expert.index');
  })->where('any', '.*')->middleware(['role:admin,expert'])->name('de.page.expert.profile');

  Route::get('en/expert/profile/{any?}', function () {
    return view('web.pages.user.expert.index');
  })->where('any', '.*')->middleware(['role:admin,expert'])->name('en.page.expert.profile');

  // Student - Course
  Route::view(
    '/de/student/profil/kurs/veranstaltung/{uuid}',
    'web.pages.user.student.index'
  )->name('de.page.student.profile.course.event')->middleware(['role:student']);
  Route::view(
    '/en/student/profile/course/event/{uuid}',
    'web.pages.user.student.index'
  )->name('en.page.student.profile.course.event')->middleware(['role:student']);

  // Student - Profile
  Route::get('de/student/profil/{any?}', function () {
    return view('web.pages.user.student.index');
  })->where('any', '.*')->middleware(['role:student'])->name('de.page.student.profile');

  Route::get('en/student/profile/{any?}', function () {
    return view('web.pages.user.student.index');
  })->where('any', '.*')->middleware(['role:student'])->name('en.page.student.profile');


  // Student - Checkout and Payment
  Route::middleware(['role:student'])->group(function() {
    Route::get('/de/checkout/basket', [CheckoutController::class, 'index'])->name('de.page.checkout.basket');
    Route::get('/en/checkout/basket', [CheckoutController::class, 'index'])->name('en.page.checkout.basket')->middleware(['role:admin']);  // remove MIDDLEWARE if multilanguage for all users

    Route::get('de/checkout/address', [CheckoutController::class, 'index'])->name('de.page.checkout.user');
    Route::get('en/checkout/address', [CheckoutController::class, 'index'])->name('en.page.checkout.user')->middleware(['role:admin']); // remove MIDDLEWARE if multilanguage for all users

    Route::get('de/checkout/payment', [CheckoutController::class, 'index'])->name('de.page.checkout.payment');
    Route::get('en/checkout/payment', [CheckoutController::class, 'index'])->name('en.page.checkout.payment')->middleware(['role:admin']); // remove MIDDLEWARE if multilanguage for all users

    Route::get('de/checkout/summary', [CheckoutController::class, 'index'])->name('de.page.checkout.summary');
    Route::get('en/checkout/summary', [CheckoutController::class, 'index'])->name('en.page.checkout.summary')->middleware(['role:admin']); // remove MIDDLEWARE if multilanguage for all users

    Route::get('de/checkout/confirmation', [CheckoutController::class, 'confirmation'])->name('de.page.checkout.confirmation');
    Route::get('en/checkout/confirmation', [CheckoutController::class, 'confirmation'])->name('en.page.checkout.confirmation')->middleware(['role:admin']); // remove MIDDLEWARE if multilanguage for all users

    Route::get('checkout/{any?}', [CheckoutController::class, 'index']);

    Route::get('de/zahlung/rechnung/{invoice:uuid}', [PaymentController::class, 'index'])->name('de.page.payment.overview');
    Route::get('en/payment/invoice/{invoice:uuid}', [PaymentController::class, 'index'])->name('en.page.payment.overview')->middleware(['role:admin']); // remove MIDDLEWARE if multilanguage for all users

    Route::get('de/zahlung/erfolgreich', [PaymentController::class, 'success'])->name('de.page.payment.success');
    Route::get('en/payment/success', [PaymentController::class, 'success'])->name('en.page.payment.success')->middleware(['role:admin']); // remove MIDDLEWARE if multilanguage for all users

    Route::get('de/zahlung/abbrechen', [PaymentController::class, 'cancel'])->name('de.page.payment.cancel');
    Route::get('en/payment/cancel', [PaymentController::class, 'cancel'])->name('en.page.payment.cancel')->middleware(['role:admin']); // remove MIDDLEWARE if multilanguage for all users

    Route::post('/payment/checkout/session', [PaymentController::class, 'create'])->name('page.payment.checkout.session');

  });

  // Routes for user with multiple roles
  Route::get('/de/roles', [RolesController::class, 'index'])->name('de.page.role.select')->middleware(['role:admin']);
  Route::get('/en/roles', [RolesController::class, 'index'])->name('en.page.role.select')->middleware(['role:admin']);
  Route::get('/de/role/{role:uuid}', [RolesController::class, 'set'])->name('de.page.role.set')->middleware(['role:admin']);
  Route::get('/en/role/{role:uuid}', [RolesController::class, 'set'])->name('en.page.role.set')->middleware(['role:admin']);

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
  if (auth()->user()) {
    return redirect()->route('de.page.home');
  }
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