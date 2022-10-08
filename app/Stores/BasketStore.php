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
      $store['items'][] = $item;
      $store['count'] = collect($store['items'])->count();
    }

    session([$this->key => $store]);
    return $store;
  }

  /**
   * Add user data
   * 
   * @param Array $user_data
   * @return Array $store
   */

  public function addUser($data)
  { 
    $store = $this->get();
    $store['user_uuid'] = $data['user_uuid'];
    $store['invoice_address_uuid'] = $data['invoice_address_uuid'];
    session([$this->key => $store]);
    return $store;
  }

  /**
   * Add payment data
   * 
   * @param Array $user_data
   * @return Array $store
   */

  public function addPayment($data)
  { 
    $store = $this->get();
    $store['discount_code_uuid'] = $data['discount_code_uuid'];
    $store['discount_code'] = $data['discount_code'];
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
      $index = collect($store['items'])->search($item);
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
      return collect($store['items'])->search($item) !== FALSE ? TRUE : FALSE;
    }
    return FALSE;
  }

  /**
   * Get the items count
   * 
   * @return Number $items
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
}