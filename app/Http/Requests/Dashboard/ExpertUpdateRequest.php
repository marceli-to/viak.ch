<?php
namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExpertUpdateRequest extends FormRequest
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
      'gender_id' =>  'required|exists:App\Models\Gender,id',
      'country_id' => 'required|exists:App\Models\Country,id',
      'roles' => 'required|array|min:1',
      'new_email' => 'nullable|email|max:255|unique:users,email',
      'new_password' => 'nullable|required_with:new_password_confirmation|same:new_password_confirmation|min:8',
      'new_password_confirmation' => 'nullable|min:8',
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
        'error' => 'Nachname wird benötigt'
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
      'roles.required' => [
        'field' => 'roles',
        'error' => 'Benutzerrolle wird benötigt'
      ],
      'new_email.email' => [
        'field' => 'new_email',
        'error' => 'E-Mail ist nicht gültig'
      ],
      'new_email.unique' => [
        'field' => 'new_email',
        'error' => 'E-Mail kann nicht verwendet werden'
      ],
      'new_email.max' => [
        'field' => 'new_email',
        'error' => 'E-Mail darf nicht länger als 255 Zeichen sein'
      ],
      'new_password.required_with' => [
        'field' => 'new_password',
        'error' => 'Passwort wird benötigt'
      ],
      'new_password.same' => [
        'field' => 'new_password',
        'error' => 'Passwort muss mit Bestätigung übereinstimmen'
      ],
      'new_password.min' => [
        'string' => [
          'field' => 'new_password',
          'error' => 'Passwort muss mind. 8 Zeichen lang sein'
        ]
      ],
      'new_password_confirmation.min' => [
        'string' => [
          'field' => 'new_password_confirmation',
          'error' => 'Passwortbestätigung muss mind. 8 Zeichen lang sein'
        ]
      ],
    ];
  }
}