<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class EventMessageResource extends JsonResource
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
      'date' => date('d.m.Y', strtotime($this->created_at)),
      'subject' => $this->subject,
      'body' => $this->body,
      'user' => $this->user->fullname
    ];
  }
}
