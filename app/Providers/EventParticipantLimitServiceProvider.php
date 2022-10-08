<?php
namespace App\Providers;
use App\Facades\EventParticipantLimit;
use Illuminate\Support\ServiceProvider;

class EventParticipantLimitServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('eventParticipantLimit', function(){
      return new EventParticipantLimit();
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
