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
    return [
      'uuid' => $this->uuid,
      'date' => $this->date_short,
      'name' => $this->name,
      'uri' => $this->uri,
      'type' => $this->type,
      'document_title' => $this->getType($this->type),
      'course_title' => $this->booking->event->course->title,
      'course_date' => $this->booking->event->date_short,
      'number' => $this->type = 'INVOICE' ? $this->invoice->number : NULL,
      'total' => $this->type = 'INVOICE' ? $this->invoice->total : NULL
    ];
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
