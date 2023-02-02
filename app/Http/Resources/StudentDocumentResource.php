<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentDocumentResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request)
  {
    $data = [
      'uuid' => $this->uuid,
      'date' => $this->date_short,
      'name' => $this->name,
      'uri' => $this->uri,
      'type' => $this->type,
      'document_title' => $this->getType($this->type),
    ];

    if ($this->type == 'INVOICE')
    {
      $invoice_data = [
        'course_title' => $this->invoice->booking->event->course->title,
        'course_date' =>  $this->invoice->booking->event->date_short,
        'number' => $this->invoice->number,
        'total' => $this->invoice->total,
      ];

      $data = array_merge($data, $invoice_data);
    }

    if ($this->type == 'PARTICIPATION_CONFIRMATION')
    {
      $confirmation_data = [
        'course_title' => $this->booking?->event->course->title,
        'course_date' =>  $this->booking?->event->date_short,       
      ];
      $data = array_merge($data, $confirmation_data);
    }

    return $data;
  }

  public function getType($type)
  {
    $types = [
      'INVOICE' => 'Rechnung',
      'PARTICIPATION_CONFIRMATION' => 'Teilnahmebestätigung'
    ];
    return $types[$type];
  }
}
