<?php
namespace App\Helpers;
use Illuminate\Support\Str;

class SlugHelper
{
  public static function make($str = NULL)
  {
    $slug = '';
    $slug = Str::slug(SlugHelper::transliterate($str), '-');
    return $slug;
  }

  public static function transliterate($string = NULL)
  {
    $search = array(
      'ä', 'ö', 'ü', 'é', 'è', 'â', 'à', 'ç',
    );

    $replace = array(
      'ae', 'oe', 'ue', 'e', 'e', 'a', 'a', 'c',
    );
    return (string) str_replace($search, $replace, mb_strtolower($string, 'UTF-8'));
  }

}