<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StudentRegisterRequest extends FormRequest
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
      'password' => 'required|string|min:8',
      'name' => 'required',
      'firstname' => 'required',
      'street' => 'required',
      'zip' => 'required',
      'city' => 'required',
      'invoice_address' => 'required_if:has_invoice_address,true',
      'accept_tos' => 'required',
      'gender_id' =>  'exists:App\Models\Gender,id'
    ];
  }

  /**
   * Custom message for validation
   *
   * @return array
   */


  public function messages()
  {
    return [];
  }
}