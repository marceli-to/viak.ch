<?php
namespace App\Providers;
use App\Facades\Discount;
use Illuminate\Support\ServiceProvider;

class DiscountServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('discount', function(){
      return new Discount();
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
