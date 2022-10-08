<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class DiscountFacade extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'discount';
  }
}