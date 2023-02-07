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
    if ($this->type == 'INVOICE')
    {
      return [
        'uuid' => $this->uuid,
        'date' => $this->date_short,
        'name' => $this->name,
        'uri' => $this->uri,
        'type' => $this->type,
        'document_title' => $this->getType($this->type),
        'course_title' => $this->invoice->booking->event->course->title,
        'course_date' =>  $this->invoice->booking->event->date_short,
        'number' => $this->invoice->number,
        'total' => $this->invoice->total,
        'grand_total' => $this->invoice->grand_total,
        'status' => $this->invoice->status
      ];
    }

    if ($this->type == 'PARTICIPATION_CONFIRMATION')
    {
      return [
        'uuid' => $this->uuid,
        'date' => $this->date_short,
        'name' => $this->name,
        'uri' => $this->uri,
        'type' => $this->type,
        'document_title' => $this->getType($this->type),
        'course_title' => $this->booking?->event->course->title,
        'course_date' =>  $this->booking?->event->date_short,       
      ];
    }
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
