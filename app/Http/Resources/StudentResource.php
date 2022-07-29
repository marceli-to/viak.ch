<?php
namespace App\Http\Resources;
use App\Http\Resources\BookingResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
      'firstname' => $this->firstname,
      'name' => $this->name,
      'address' => $this->address,
      'street' => $this->street,
      'street_no' => $this->street_no,
      'zip' => $this->zip,
      'city' => $this->city,
      'phone' => $this->phone,
      'has_invoice_address' => $this->has_invoice_address,
      'invoice_address' => $this->invoice_address,
      'operating_system' => $this->operating_system,
      'email' => $this->email,
      'gender_id' => $this->gender_id,
      'bookings' => BookingResource::collection($this->activeBookings),
    ];
  }
}
