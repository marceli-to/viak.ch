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
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required_with:password_confirmation|same:password_confirmation|min:8',
      'password_confirmation' => 'min:8',
      'name' => 'required',
      'firstname' => 'required',
      'street' => 'required',
      'zip' => 'required',
      'city' => 'required',
      'invoice_address' => 'required_if:has_invoice_address,true',
      'accept_tos' => 'required|boolean',
      'gender_id' =>  'required|exists:App\Models\Gender,id'
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
      'email.string' => [
        'field' => 'email',
        'error' => 'E-Mail muss vom Typ "String" sein'
      ],
      'email.unique' => [
        'field' => 'email',
        'error' => 'E-Mail kann nicht verwendet werden'
      ],
      'email.max' => [
        'field' => 'email',
        'error' => 'E-Mail darf nicht länger als 255 Zeichen sein'
      ],
      'password.required' => [
        'field' => 'password',
        'error' => 'Passwort wird benötigt'
      ],
      'password.same' => [
        'field' => 'password',
        'error' => 'Passwort muss mit Passwort wiederholen übereinstimmen'
      ],
      'password.min' => [
        'field' => 'password',
        'error' => 'Passwort muss mind. 8 Zeichen lang sein'
      ],
      'password_confirmation.min' => [
        'field' => 'password_confirmation',
        'error' => 'Passwort muss mind. 8 Zeichen lang sein'
      ],
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
      'accept_tos.required' => [
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
    ];
  }
}