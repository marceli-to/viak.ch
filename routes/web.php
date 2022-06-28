<?php
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RolesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('page.home');

// Public auth routes
Auth::routes(['verify' => true, 'register' => false]);
Route::get('/logout', [LoginController::class, 'logout']);

// Protected routes
Route::middleware('auth:sanctum', 'verified')->group(function() {

  // Routes for user with multiple roles
  Route::get('/administration/roles', [RolesController::class, 'index'])->name('page.role.select');
  Route::get('/administration/role/{role:uuid}', [RolesController::class, 'set'])->name('page.role.set');

  Route::get('/administration/test', [TestController::class, 'test'])->middleware(['role:admin,student,expert']);


  // 
  Route::get('/administration/{any?}', function () {
    return view('layout.authenticated');
  })->where('any', '.*')->middleware(['role:admin']);
});


