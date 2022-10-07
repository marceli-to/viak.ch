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
   * Get a discount code by its uuid
   *
   * @return String $discountCodeUuid
   */

  public function getByUuid($discountCodeUuid)
  {
    return DiscountCode::where('uuid', $discountCodeUuid)->first();
  }

  /**
   * Get a discount code by its code
   *
   * @return String $discountCode
   */

  public function getByCode($discountCode)
  {
    return DiscountCode::where('code', $discountCode)->first();
  }

  /**
   * Apply a discount code
   *
   * @param String $discountCodeUuid
   * @param Integer $total
   */

  public function apply($discountCodeUuid, $total = NULL)
  {
    if ($this->validate($discountCodeUuid))
    {
      $discountCode = $this->getByUuid($discountCodeUuid);
      if ($discountCode->percent)
      {
        return ($total / 100 * (int) $discountCode->amount);
      }

      return $discountCode->amount;
    }

    return $discountCode->amount;
  }

  /**
   * Validate a discount code
   *
   * @return String $discountCodeUuid
   */
  
  public function validate($discountCodeUuid)
  {
    $discountCode = $this->getByUuid($discountCodeUuid);
    if ($discountCode && $discountCode->isValid())
    {
      return TRUE;
    }
    return FALSE;
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