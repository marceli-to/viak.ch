<?php
namespace App\Providers;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Course;

class RouteServiceProvider extends ServiceProvider
{
  /**
   * This namespace is applied to your controller routes.
   *
   * In addition, it is set as the URL generator's root namespace.
   *
   * @var string
   */
  protected $namespace = 'App\Http\Controllers';

  /**
   * The path to the "home" route for your application.
   *
   * @var string
   */
  public const HOME = '/';

  /**
   * The path to the "dashboard" route for your application.
   *
   * @var string
   */
  public const DASHBOARD = '/dashboard';

  /**
   * The path to the "dashboard/courses" route for your application.
   *
   * @var string
   */
  public const DASHBOARD_COURSES = '/dashboard/courses';
  
  /**
   * The path to the "roles" route for your application.
   *
   * @var string
   */
  public const DASHBOARD_ROLES = '/de/roles';
  
  /**
   * The path to the "dashboard/courses" route for your application.
   *
   * @var string
   */
  public const EXPERT_PROFILE = '/de/experte/profil';

  /**
   * Define your route model bindings, pattern filters, etc.
   *
   * @return void
   */
  public function boot()
  {
    parent::boot();
  }

  /**
   * Define the routes for the application.
   *
   * @return void
   */
  public function map()
  {
    $this->mapApiRoutes();
    $this->mapWebRoutes();
  }

  /**
   * Define the "web" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapWebRoutes()
  {
    Route::middleware('web')
        ->namespace($this->namespace)
        ->group(base_path('routes/web.php'));
  }

  /**
   * Define the "api" routes for the application.
   *
   * These routes are typically stateless.
   *
   * @return void
   */
  protected function mapApiRoutes()
  {
    Route::prefix('api')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/api.php'));
  }
}
