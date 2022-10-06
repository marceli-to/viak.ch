<?php
namespace App\Providers;
use App\Policies\BookingPolicy;
use App\Policies\BookmarkPolicy;
use App\Policies\EventPolicy;
use App\Policies\UserAddressPolicy;
use App\Models\Booking;
use App\Models\Bookmark;
use App\Models\Event;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
    Booking::class => BookingPolicy::class,
    Bookmark::class => BookmarkPolicy::class,
    Event::class => EventPolicy::class,
    UserAddress::class => UserAddressPolicy::class,
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();
  }
}
