<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class MessageStoreRequest extends FormRequest
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
      'event_uuid' => 'required|exists:App\Models\Event,uuid',
      'subject' => 'required',
      'body' => 'required',
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
        'error' => 'Kurs wird benötigt'
      ],
      'event_uuid.exists' => [
        'field' => 'event_uuid',
        'error' => 'Kurs wird benötigt'
      ],
      'subject.require' => [
        'field' => 'subject',
        'error' => 'Betreff wird benötigt'
      ],
      'body.required' => [
        'field' => 'body',
        'error' => 'Inhalt wird benötigt'
      ],
    ];
  }
}