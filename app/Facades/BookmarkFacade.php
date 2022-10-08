<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class BookmarkFacade extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'bookmark';
  }
}