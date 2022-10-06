<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StudentAddressRequest extends FormRequest
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
      'name' => 'required_without:company',
      'company' => 'required_without:name',
      'street' => 'required',
      'city' => 'required',
      'zip' => 'required',
      'country_id' => 'required|exists:App\Models\Country,id',
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
       'name.required_without' => [
        'field' => 'name',
        'error' => 'Name oder Firma wird benötigt'
      ],
      'company.required_without' => [
        'field' => 'company',
        'error' => 'Name oder Firma wird benötigt'
      ],
      'zip.required' => [
        'field' => 'zip',
        'error' => 'PLZ wird benötigt'
      ],
      'street.required' => [
        'field' => 'street',
        'error' => 'Strasse wird benötigt'
      ],
      'city.required' => [
        'field' => 'city',
        'error' => 'Ort wird benötigt'
      ],
      'country_id.required' => [
        'field' => 'country_id',
        'error' => 'Land wird benötigt'
      ],
    ];
  }
}