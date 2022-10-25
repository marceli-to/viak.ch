<?php
namespace App\Helpers;
use Illuminate\Support\Str;

class AppHelper
{
  public static function nl2p($string = NULL)
  {
    $string = nl2br($string, false);
    return '<p>' . preg_replace('#(<br>[\r\n\s]+){2}#', '</p><p>', $string) . '</p>';
  }

  public static function linkTarget($url = NULL)
  {
    if (!\Str::contains($url, env('APP_URL')))
    {
      return '_blank';
    }
    return '_self';
  }
}