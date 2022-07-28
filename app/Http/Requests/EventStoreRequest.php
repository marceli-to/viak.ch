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
      'number' => 'required',
      'title.de' => 'required',
      'subtitle.de' => 'required',
      'text.de' => 'required',
      'category_ids' => 'required|array|min:1',
      'category_ids.*'  => 'required|min:1',
      'language_ids' => 'required|array|min:1',
      'language_ids.*'  => 'required|min:1',
      'level_ids' => 'required|array|min:1',
      'level_ids.*'  => 'required|min:1',
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
      'number.required' => [
        'field' => 'number',
        'error' => 'Nummer wird benötigt'
      ],
      'title.de.required' => [
        'field' => 'title',
        'error' => 'Titel wird benötigt'
      ],
      'subtitle.de.required' => [
        'field' => 'subtitle',
        'error' => 'Subtitel wird benötigt'
      ],
      'text.de.required' => [
        'field' => 'text',
        'error' => 'Text wird benötigt'
      ],
      'category_ids.required' => [
        'field' => 'category_ids',
        'error' => 'Kategorie wird benötigt'
      ],
      'category_ids.min' => [
        'string' => [
          'field' => 'category_ids',
          'error' => 'Kategorie muss mind. 1 Element enthalten'
        ]
      ],
      'language_ids.required' => [
        'field' => 'language_ids',
        'error' => 'Sprache wird benötigt'
      ],
      'language_ids.min' => [
        'string' => [
          'field' => 'language_ids',
          'error' => 'Sprache muss mind. 1 Element enthalten'
        ]
      ],
      'level_ids.required' => [
        'field' => 'level_ids',
        'error' => 'Level wird benötigt'
      ],
      'level_ids.min' => [
        'string' => [
          'field' => 'level_ids',
          'error' => 'Level muss mind. 1 Element enthalten'
        ]
      ],
    ];
  }
}