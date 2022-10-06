<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Models\DiscountCode;

class Discount
{
  public const PREFIX = 'VIAK';
  
  public const SEPARATOR = '-'; 

  /**
   * Generate a discount code
   *
   * @return String $code
   */
  public function create()
  {
    return $this->generate();
  }

  /**
   * Generate a discount code
   *
   * @return String $code
   */

  private function generate()
  {
    $chars  = 'ABCDEFGHJKMNPQRSTUVWXYZ23456789';
    $string = self::PREFIX . self::SEPARATOR;
    $length = 4;
 
    for ($i = 0; $i <= 1; $i++)
    {
      for ($ii = 1; $ii <= $length; $ii++)
      {
        $index   = rand(0, strlen($chars) - 1);
        $string .= $chars[$index];
      }

      if ($i < 1)
      {
        $string .= self::SEPARATOR;
      }
    }

    while($this->exists($string) == FALSE)
    {
      $this->generate();
    }

    return $string;
  }

  /**
   * Check for existing discount codes by checking all existing db records
   *
   * @param  String $discountCode
   * @return Boolean
   */

  private function exists($code)
  {
    return DiscountCode::where('code', $code)->first() == NULL ? TRUE : FALSE;
  }

}