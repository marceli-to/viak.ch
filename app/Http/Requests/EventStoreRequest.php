<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
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
      'course_id' => 'required|exists:App\Models\Gender,id',
      'min_participants' => 'required|gt:0',
      'max_participants' => 'required|gt:0',
      'dates' => 'required|array|min:1',
      'dates.*'  => 'required|min:1',
      'expert_ids' => 'required|array|min:1',
      'expert_ids.*'  => 'required|min:1',
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
      'min_participants.required' => [
        'field' => 'min_participants',
        'error' => 'min. Teilnehmer wird benötigt'
      ],
      'min_participants.gt' => [
        'field' => 'min_participants',
        'error' => 'min. Teilnehmer wird benötigt'
      ],
      'max_participants.required' => [
        'field' => 'max_participants',
        'error' => 'max. Teilnehmer wird benötigt'
      ],
      'max_participants.gt' => [
        'field' => 'max_participants',
        'error' => 'max. Teilnehmer wird benötigt'
      ],
      'dates.required' => [
        'field' => 'dates',
        'error' => 'Datum wird benötigt'
      ],
      'dates.min' => [
        'string' => [
          'field' => 'dates',
          'error' => 'Datum muss mind. 1 Element enthalten'
        ]
      ],
      'expert_ids.required' => [
        'field' => 'expert_ids',
        'error' => 'Experte wird benötigt'
      ],
      'expert_ids.min' => [
        'string' => [
          'field' => 'expert_ids',
          'error' => 'Experten muss mind. 1 Element enthalten'
        ]
      ],
    ];
  }
}