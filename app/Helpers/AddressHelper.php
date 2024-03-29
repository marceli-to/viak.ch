<?php
namespace App\Helpers;
use App\Models\Country;
use Illuminate\Support\Str;

class AddressHelper
{
  public static function get($data)
  {
    $address  = '';
    if ($data['company'])
    {
      $address .= "{$data['company']}<br>";
    }

    if ($data['firstname'] || $data['name'])
    {
      $name = '';
      if ($data['firstname'])
      {
        $name .= "{$data['firstname']} ";
      }
      if ($data['name'])
      {
        $name .= "{$data['name']}";
      }
      $address .= "{$name}<br>";
    }
    $address .= "{$data['street']} {$data['street_no']}<br>";
    $address .= "{$data['zip']} {$data['city']}";

    if ($data['country_id'] !== Country::HOME)
    {
      $address .= "<br>";
      $address .= Country::find($data['country_id'])->name;
    }

    return $address;
  }

}