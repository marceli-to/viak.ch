<?php
namespace App\Helpers;

class FormatHelper
{
  public static function number($amount)
  {
    return number_format(round($amount * 20) / 20, 2, '.', '');
  }
}