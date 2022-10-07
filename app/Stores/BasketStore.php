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
    
    $store['user'] = [
      'uuid' => $data['user_uuid'],
      'invoice_address_uuid' => $data['invoice_address_uuid']
    ];
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
   * Get a single basket item
   * 
   * @param String $item
   * @return Boolean 
   */

  public function getItem($item = NULL)
  { 
    $store = $this->get();
    if (isset($store['items']))
    {
      return collect($store['items'])->search($item) !== FALSE ? TRUE : FALSE;
    }
    return FALSE;
  }

  /**
   * Get the basket user
   * 
   * @param String $item
   * @return Boolean 
   */

  public function getUser($item = NULL)
  { 
    $store = $this->get();
    if (isset($store['user']))
    {
      return $store['user'];
    }
    return FALSE;
  }

  /**
   * Get the items count
   * 
   * @return Number $items
   */
 
  public function getItemsCount()
  { 
    $store = $this->get();
    if (isset($store['items']))
    {
      return collect($store['items'])->count();
    }
    return NULL;
  }
}