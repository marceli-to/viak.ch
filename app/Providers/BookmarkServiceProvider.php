<?php
namespace App\Providers;
use App\Facades\Bookmark;
use Illuminate\Support\ServiceProvider;

class BookmarkServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('bookmark', function(){
      return new Bookmark();
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
