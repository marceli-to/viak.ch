<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class DiscountCodeUpdateRequest extends FormRequest
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
      'code' => 'required',
      'amount' => 'required',
      'valid_from' => 'nullable|required_with:valid_to|date_format:d.m.Y|before_or_equal:valid_to',
      'valid_to' => 'nullable|required_with:valid_from|date_format:d.m.Y|after_or_equal:valid_from',
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
      'valid_from.required_with' => [
        'field' => 'valid_from',
        'error' => 'Gültig von wird benötigt'
      ],
      'valid_to.required_with' => [
        'field' => 'valid_to',
        'error' => 'Gültig bis wird benötigt'
      ],
    ];
  }
}