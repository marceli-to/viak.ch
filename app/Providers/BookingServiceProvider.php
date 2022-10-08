<?php
namespace App\Providers;
use App\Facades\Booking;
use Illuminate\Support\ServiceProvider;

class BookingServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('booking', function(){
      return new Booking();
    });
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
