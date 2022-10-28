<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class NewsletterSubscriberFacade extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'newsletterSubscriber';
  }
}