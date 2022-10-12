<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    // Set locales
    setLocale(LC_ALL, 'de_CH');
    \Carbon\Carbon::setLocale('de_CH');

    // Set global mailto address
    if ($this->app->environment('local'))
    {
      Mail::alwaysTo('m@marceli.to');
    }

  }
}
