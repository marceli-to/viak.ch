<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class ParticipantsChangeFacade extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'participantsChange';
  }
}