<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class BookingParticipationRequest extends FormRequest
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
      'event_uuid' => 'exists:App\Models\Event,uuid',
      'student_uuid' => 'exists:App\Models\User,uuid',
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
      'event_uuid.required' => [
        'field' => 'event_uuid',
        'error' => 'Veranstaltung wird benötigt'
      ],
      'student_uuid.exists' => [
        'field' => 'student_uuid',
        'error' => 'Student wird benötigt'
      ],
    ];
  }
}