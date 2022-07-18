<?php
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RolesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('page.home');

Route::get('/kurse', [CourseController::class, 'list'])->name('page.courses');
Route::get('/kurs/{slug?}/{course:uuid}', [CourseController::class, 'show'])->name('page.course');

Route::get('/experten', [ExpertController::class, 'list'])->name('page.experts');
Route::get('/experte/{slug?}/{user:uuid}', [ExpertController::class, 'show'])->name('page.expert');

Route::get('/student/register', [StudentController::class, 'register'])->name('page.student.register');
Route::get('/student/profile', [StudentController::class, 'profile'])->name('page.student.profile');

// Public auth routes
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

  // 
  Route::get('/administration/{any?}', function () {
    return view('web.layout.backend');
  })->where('any', '.*')->middleware(['role:admin']);
});


