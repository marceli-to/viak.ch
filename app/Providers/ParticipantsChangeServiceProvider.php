<?php
namespace App\Providers;
use App\Facades\ParticipantsChange;
use Illuminate\Support\ServiceProvider;

class ParticipantsChangeServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('participantsChange', function(){
      return new ParticipantsChange();
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
