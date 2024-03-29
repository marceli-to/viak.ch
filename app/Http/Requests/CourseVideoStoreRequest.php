<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CourseVideoStoreRequest extends FormRequest
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
      'course_id' => 'required|exists:App\Models\Course,id',
      'code' => 'required',
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
      'course_id.required' => [
        'field' => 'course_id',
        'error' => 'Kurs wird benötigt'
      ],
      'course_id.exists' => [
        'field' => 'course_id',
        'error' => 'Kurs wird benötigt'
      ],
      'code.required' => [
        'field' => 'code',
        'error' => 'Code wird benötigt'
      ],
    ];
  }
}