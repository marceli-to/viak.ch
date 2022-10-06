<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class DiscountCodeStoreRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */

  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */

  public function rules()
  {
    return [
      'code' => 'required|unique:discount_codes',
      'amount' => 'required',
    ];
  }

  /**
   * Custom message for validation
   *
   * @return array
   */
  
  public function messages()
  {
    return [
      'code.required' => [
        'field' => 'code',
        'error' => 'Discount Code wird benötigt'
      ],
      'code.unique' => [
        'field' => 'code',
        'error' => 'Discount Code wird benötigt'
      ],
      'amount.required' => [
        'field' => 'amount',
        'error' => 'Höhe wird benötigt'
      ],
    ];
  }
}