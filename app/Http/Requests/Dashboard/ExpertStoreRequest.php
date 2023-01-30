<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;

class ExpertStoreRequest extends FormRequest
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
      'name' => 'required',
      'firstname' => 'required',
      'street' => 'required',
      'zip' => 'required',
      'city' => 'required',
      'email' => 'required|email|max:255|unique:users',
      'gender_id' =>  'required|exists:App\Models\Gender,id',
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
      'name.required' => [
        'field' => 'name',
        'error' => 'Name wird benötigt'
      ],
      'firstname.required' => [
        'field' => 'firstname',
        'error' => 'Vorname wird benötigt'
      ],
      'street.required' => [
        'field' => 'street',
        'error' => 'Strasse wird benötigt'
      ],
      'zip.required' => [
        'field' => 'zip',
        'error' => 'PLZ wird benötigt'
      ],
      'city.required' => [
        'field' => 'city',
        'error' => 'Ort wird benötigt'
      ],
      'gender_id.required' => [
        'field' => 'gender_id',
        'error' => 'Geschlecht wird benötigt'
      ],
      'gender_id.exists' => [
        'field' => 'gender_id',
        'error' => 'Geschlecht wird benötigt'
      ],
      'country_id.required' => [
        'field' => 'country_id',
        'error' => 'Land wird benötigt'
      ],
      'country_id.exists' => [
        'field' => 'country_id',
        'error' => 'Land wird benötigt'
      ],
    ];
  }
}