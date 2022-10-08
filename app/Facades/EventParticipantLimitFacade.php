<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class EventParticipantLimitFacade extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'eventParticipantLimit';
  }
}