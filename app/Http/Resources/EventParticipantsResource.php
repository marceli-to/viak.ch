<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class EventParticipantsResource extends JsonResource
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
      'fullname' => $this->fullname,
      'name' => $this->name,
      'firstname' => $this->firstname,
      'city' => $this->city,
      'email' => auth()->user()->isAdmin() ? $this->email : null,
    ];
  }
}
