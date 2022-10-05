<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
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
      'country_id' => $this->country_id,
    ];
  }
}
