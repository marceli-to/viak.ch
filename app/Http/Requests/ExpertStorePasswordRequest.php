<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ExpertStorePasswordRequest extends FormRequest
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
      'password' => 'required|required_with:password_confirmation|same:password_confirmation|min:8',
      'password_confirmation' => 'required|min:8',
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