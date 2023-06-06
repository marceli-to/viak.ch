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
      'uuid' => $this->user->uuid,
      'fullname' => $this->user->fullname,
      'name' => $this->user->name,
      'firstname' => $this->user->firstname,
      'city' => $this->user->city,
      'company' => $this->user->company,
      'email' => auth()->user()->isAdmin() ? $this->user->email : null,
      'hasParticipated' => $this->hasFlag('hasParticipated') ? true : false
    ];
  }
}
