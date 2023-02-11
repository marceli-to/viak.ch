<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    if ($this->app->isLocal())
    {
      $this->app->register(\Amirami\Localizator\ServiceProvider::class);
    }
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    // Set locales
    setLocale(LC_ALL, 'de_CH.utf8');
    setlocale (LC_TIME, 'de_CH.utf8');
    \Carbon\Carbon::setLocale('de_CH.utf8');

    // Set global mailto address
    if ($this->app->environment('local') || $this->app->environment('staging'))
    {
      Mail::alwaysTo(env('MAIL_TO'));
    }

    // Add 'whereLike' to the query builder
    Builder::macro('whereLike', function(string $attribute, string $searchTerm) {
      return $this->where($attribute, 'LIKE', "%{$searchTerm}%");
    });
    
    // Add 'orWhereLike' to the query builder
    Builder::macro('orWhereLike', function(string $attribute, string $searchTerm) {
      return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
    });
  }
}
