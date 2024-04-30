<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class RentalResource extends JsonResource
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
      'fullname' => $this->user->full_name,
      'email' => $this->user->email,
      'city' => $this->user->city,
    ];
  }
}
