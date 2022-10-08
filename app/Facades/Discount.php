<?php
namespace App\Facades;
use Illuminate\Http\Request;
use App\Models\DiscountCode as DiscountCodeModel;

class Discount
{
  public const PREFIX = 'VIAK';
  
  public const SEPARATOR = '-'; 

  /**
   * Generate a discount code
   *
   * @return String $discountCode
   */

  public function create()
  {
    return self::generate();
  }

  /**
   * Get a discount code by its uuid
   * 
   * @param DiscountCode $discountCode
   * @return String $discountCodeUuid
   */

  public function getByUuid($discountCodeUuid)
  {
    return DiscountCodeModel::where('uuid', $discountCodeUuid)->first();
  }

  /**
   * Get a discount code by its code
   *
   * @param String $discountCode
   * @return DiscountCode $discountCode
   */

  public function getByCode($discountCode)
  {
    return DiscountCodeModel::where('code', $discountCode)->first();
  }

  /**
   * Apply a discount code
   *
   * @param String $discountCodeUuid
   * @param Integer $total
   * @return Mixed $amount
   */

  public function apply($discountCodeUuid, $total = NULL)
  {
    if (self::validate($discountCodeUuid))
    {
      $discountCode = self::getByUuid($discountCodeUuid);
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
   * @param String $discountCodeUuid
   * @return Boolean
   */
  
  public function validate($discountCodeUuid)
  {
    $discountCode = self::getByUuid($discountCodeUuid);
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

  public function generate()
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

    while(self::exists($string) == FALSE)
    {
      self::generate();
    }

    return $string;
  }

  /**
   * Check for existing discount codes by checking all existing db records
   *
   * @param  String $discountCode
   * @return Boolean
   */

  public function exists($code)
  {
    return DiscountCodeModel::where('code', $code)->first() == NULL ? TRUE : FALSE;
  }
}