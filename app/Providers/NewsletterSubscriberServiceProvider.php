<?php
namespace App\Providers;
use App\Facades\NewsletterSubscriber;
use Illuminate\Support\ServiceProvider;

class NewsletterSubscriberServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('newsletterSubscriber', function(){
      return new NewsletterSubscriber();
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
