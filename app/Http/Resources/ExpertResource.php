<?php
namespace App\Http\Resources;
use App\Http\Resources\EventResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpertResource extends JsonResource
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
      'company' => $this->company,
      'fullname' => $this->fullname,
      'firstname' => $this->firstname,
      'name' => $this->name,
      'address' => $this->address,
      'street' => $this->street,
      'street_no' => $this->street_no,
      'zip' => $this->zip,
      'city' => $this->city,
      'phone' => $this->phone,
      'email' => $this->email,
      'gender_id' => $this->gender_id,
      'country_id' => $this->country_id,
      'upcoming_events' => EventResource::collection($this->upcomingEvents)
    ];
  }
}
