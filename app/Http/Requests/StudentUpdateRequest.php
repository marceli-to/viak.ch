<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
      'invoice_address' => 'required_if:has_invoice_address,1',
      'gender_id' =>  'required|exists:App\Models\Gender,id',
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
      'invoice_address.required_if' => [
        'field' => 'invoice_address',
        'error' => 'Rechnungsadresse wird benötigt'
      ],
      'gender_id.required' => [
        'field' => 'gender_id',
        'error' => 'Geschlecht wird benötigt'
      ],
      'gender_id.exists' => [
        'field' => 'gender_id',
        'error' => 'Geschlecht wird benötigt'
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