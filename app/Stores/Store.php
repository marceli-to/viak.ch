<?php
namespace App\Stores;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class Store
{
  protected $key = 'key';

  /**
   * Set the current store
   * 
   * @param Array $data
   * @return Array $store
   */

  public function set($data)
  { 
    session([$this->key => $data]);
  }

  /**
   * Get the current store
   * 
   * @return Array $store
   */

  public function get()
  {
    if (session()->has($this->key))
    {
      $store = session($this->key);
      return $store;
    }
    return [];
  }

  /**
   * Clear the store
   */

  public function clear()
  {
    session()->forget($this->key);
  }

  /**
   * Set an attribute
   * 
   * @param String $field
   * @param String $value
   * @return Array $store
   */

  public function setAttribute($field, $value)
  { 
    $store = $this->get();

    if (strpos($field, '.') !== FALSE)
    {
      $field = explode('.', $field);
      $store[$field[0]][$field[1]] = $value;
      session([$this->key => $store]);
      return $store;
    }

    $store[$field] = $value;
    session([$this->key => $store]);
    return $store;
  }

  /**
   * Get an attribute specified by key
   * 
   * @param String $key
   * @return Mixed $value
   */

  public function getAttribute($key)
  {
    $store = session($this->key);

    if (strpos($key, '.') !== FALSE)
    {
      $field = explode('.', $key);
      if ($store && array_key_exists($field[1], $store[$field[0]]))
      {
        return $store[$field[0]][$field[1]];
      }
    }

    if ($store && array_key_exists($key, $store))
    {
      return $store[$key];
    }
    return NULL;
  }


  /**
   * Check for the existence of an attribute.
   * 
   * @param String $attribute
   * @return Boolean $response
   */
 
  public function hasAttribute($attribute = NULL)
  { 
    $store = $this->get();
    if (isset($store[$attribute]) && collect($store[$attribute])->count() > 0)
    {
      return TRUE;
    }
    return FALSE;
  }
}