<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StudentAddressUpdateRequest extends FormRequest
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
      'invoice_address.name' => 'required_without:invoice_address.company',
      'invoice_address.company' => 'required_without:invoice_address.name',
      'invoice_address.street' => 'required',
      'invoice_address.city' => 'required',
      'invoice_address.zip' => 'required',
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
       'invoice_address.name.required_without' => [
        'field' => 'invoice_address_name',
        'error' => 'Name oder Firma wird benötigt'
      ],
      'invoice_address.company.required_without' => [
        'field' => 'invoice_address_company',
        'error' => 'Name oder Firma wird benötigt'
      ],
      'invoice_address.zip.required' => [
        'field' => 'invoice_address_zip',
        'error' => 'PLZ wird benötigt'
      ],
      'invoice_address.street.required' => [
        'field' => 'invoice_address_street',
        'error' => 'Strasse wird benötigt'
      ],
      'invoice_address.city.required' => [
        'field' => 'invoice_address_city',
        'error' => 'Ort wird benötigt'
      ],
    ];
  }
}