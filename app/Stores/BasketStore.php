<?php
namespace App\Stores;
use App\Models\User;
use App\Stores\Store;
use Illuminate\Http\Request;

class BasketStore extends Store
{ 
  protected $key = 'basket';

  /**
   * Add an item
   * 
   * @param String $item
   * @return Array $store
   */

  public function addItem($item)
  { 
    $store = $this->get();
    
    if (!isset($store['items']))
    {
      $store['items'] = [];
    }

    if (!in_array($item, $store['items']))
    {
      $store['items'][] = ['uuid' => $item];
      $store['count'] = collect($store['items'])->count();
    }

    session([$this->key => $store]);
    return $store;
  }

  /**
   * Remove an item
   * 
   * @param String $item
   * @return Array $store
   */

  public function removeItem($item)
  { 
    $store = $this->get();
    if (isset($store['items']))
    {
      // Find the item index in $store['items'] by its uuid
      $index = collect($store['items'])->search(function($value, $key) use ($item) {
        return $value['uuid'] == $item;
      });

      if ($index !== FALSE)
      {
        unset($store['items'][$index]);
      }
    }
    $store['count'] = collect($store['items'])->count();
    session([$this->key => $store]);
    return $store;
  }

    /**
   * Remove a rental an item
   * 
   * @param String $item
   * @return Array $store
   */

   public function removeRentalFromItem($item)
   { 
     $store = $this->get();
     if (isset($store['items']))
     {
       // Find the item index in $store['items'] by its uuid
       $index = collect($store['items'])->search(function($value, $key) use ($item) {
         return $value['uuid'] == $item;
       });
 
       if ($index !== FALSE)
       {
         unset($store['items'][$index]['rental']);
       }
     }
     session([$this->key => $store]);
     return $store;
   }

  /**
   * Get all basket items
   * 
   * @return Array $items
   */

  public function getItems()
  { 
    $store = $this->get();
    if (isset($store['items']))
    {
      return $store['items'];
    }
    return [];
  }

  /**
   * Check existence of a single item
   * 
   * @param String $item
   * @return Boolean 
   */

  public function hasItem($item = NULL)
  { 
    $store = $this->get();
    if (isset($store['items']))
    {
      $index = collect($store['items'])->search(function($value, $key) use ($item) {
        return $value['uuid'] == $item;
      });
      return $index !== FALSE ? TRUE : FALSE;
    }
    return FALSE;
  }

  /**
   * Get the items count
   * 
   * @return Integer $items
   */
 
  public function itemsCount()
  { 
    $store = $this->get();
    if (isset($store['items']))
    {
      return collect($store['items'])->count();
    }
    return 0;
  }

  /**
   * Add an attribute to the store
   * 
   * @param String $attribute
   * @param Mixed $data
   */
 
  public function addAttribute($attribute, $data)
  { 
    $store = $this->get();
    $store[$attribute] = $data;
    session([$this->key => $store]);
    return $store;
  }

  /**
   * Remove an attribute from the store
   * 
   * @param String $attribute
   */
 
  public function removeAttribute($attribute)
  { 
    $store = $this->get();
    if (isset($store[$attribute]))
    {
      unset($store[$attribute]);
      session([$this->key => $store]);
    }
    return $store;
  }

  /**
   * Add a rental to an item
   */

  public function addRental($item)
  { 
    $store = $this->get();
    if (isset($store['items']))
    {
      $index = collect($store['items'])->search(function($value, $key) use ($item) {
        return $value['uuid'] == $item;
      });

      if ($index !== FALSE)
      {
        if (!isset($store['items'][$index]['rental']))
        {
          $store['items'][$index]['rental'] = true;
        }
      }
    }
    session([$this->key => $store]);
    return $store;
  }
}