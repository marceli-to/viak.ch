<?php
namespace App\Http\Resources;
use App\Helpers\PenaltyHelper;
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
      'has_rental' => $this->has_rental,
      'event' => EventResource::make($this->event),
      'discount_amount' => $this->discount_amount,
      'cancellation' => $this->event->free_of_charge || PenaltyHelper::applies($this->uuid) === FALSE ? ['penalty' => null] : PenaltyHelper::get($this->event->date, $this->event->courseFee),
    ];
  }
}
