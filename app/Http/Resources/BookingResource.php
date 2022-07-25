<?php
namespace App\Http\Resources;
use App\Http\Resources\EventResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
      'number' => $this->number,
      'booked_at' => $this->booked_at,
      'event' => EventResource::make($this->event),
    ];
  }
}
