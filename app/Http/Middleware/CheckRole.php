<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Models\Role;
use Closure;

class CheckRole
{
  
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  string $role
   * @return mixed
   */

  public function handle($request, Closure $next, ...$roles)
  {
    if (auth()->user() && !auth()->user()->hasAtLeastOneRole($roles))
    {
      return abort(403);
    }
    return $next($request);
  }
}