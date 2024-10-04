<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
      'email' => 'required|email|max:255|unique:users',
      'email_confirmation' => 'required|email|max:255|same:email',
      'password' => 'required|required_with:password_confirmation|same:password_confirmation|min:8',
      'password_confirmation' => 'required|min:8',
      'name' => 'required',
      'firstname' => 'required',
      'street' => 'required',
      'zip' => 'required',
      'city' => 'required',
      'phone' => 'required',
      'accept_tos' => 'accepted',
      'gender_id' => 'required|exists:App\Models\Gender,id',
      'country_id' => 'required|exists:App\Models\Country,id'
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
      'email.required' => [
        'field' => 'email',
        'error' => 'E-Mail wird benötigt'
      ],
      'email.email' => [
        'field' => 'email',
        'error' => 'E-Mail ist nicht gültig'
      ],
      'email.unique' => [
        'field' => 'email',
        'error' => 'E-Mail kann nicht verwendet werden'
      ],
      'email.max' => [
        'field' => 'email',
        'error' => 'E-Mail darf nicht länger als 255 Zeichen sein'
      ],
      'email_confirmation.required' => [
        'field' => 'email_confirmation',
        'error' => 'E-Mail wiederholen wird benötigt'
      ],
      'email_confirmation.email' => [
        'field' => 'email_confirmation',
        'error' => 'E-Mail wiederholen ist nicht gültig'
      ],
      'email_confirmation.same' => [
        'field' => 'email_confirmation',
        'error' => 'E-Mail wiederholen muss mit E-Mail übereinstimmen'
      ],
      'password.required' => [
        'field' => 'password',
        'error' => 'Passwort wird benötigt'
      ],
      'password.required_with' => [
        'field' => 'password',
        'error' => 'Passwort wird benötigt'
      ],
      'password.same' => [
        'field' => 'password',
        'error' => 'Passwort muss mit Bestätigung übereinstimmen'
      ],
      'password.min' => [
        'string' => [
          'field' => 'password',
          'error' => 'Passwort muss mind. 8 Zeichen lang sein'
        ]
      ],
      'password_confirmation.required' => [
        'field' => 'password_confirmation',
        'error' => 'Passwortbestätigung wird benötigt'
      ],
      'password_confirmation.min' => [
        'string' => [
          'field' => 'password_confirmation',
          'error' => 'Passwortbestätigung muss mind. 8 Zeichen lang sein'
        ]
      ],
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
      'phone.required' => [
        'field' => 'phone',
        'error' => 'Telefon wird benötigt'
      ],
      'accept_tos.accepted' => [
        'field' => 'accept_tos',
        'error' => 'AGB müssen akzeptiert werden'
      ],
      'accept_tos.boolean' => [
        'field' => 'accept_tos',
        'error' => 'AGB müssen akzeptiert werden'
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