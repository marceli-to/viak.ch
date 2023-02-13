<?php
namespace App\Http\Resources\Dashboard;
use App\Http\Resources\CourseResource;
use App\Http\Resources\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
      'id' => $this->id,
      'uuid' => $this->uuid,
      'date' => $this->date_long,
      'registration_until' => $this->registration_until,
      'min_participants' => $this->min_participants,
      'max_participants' => $this->max_participants,
      'online' => $this->online,
      'fee' => $this->fee,
      'publish' => $this->publish,
      'location' => LocationResource::make($this->location),
      'dates' => $this->dates->map(function($date) {
        return [
          'date' => $date->date,
          'date_long' => $date->date_long,
          'date_short' => $date->date_short,
          'time_start' => $date->time_start,
          'time_end' => $date->time_end,
        ];
      }),
      //'bookings' => $this->is_cancelled ? $this->cancelledBookings->count() : $this->bookings->count(),
      'bookings' = collect($this->hasFlag('isCancelled') ? $this->cancelledBookings : $this->bookings)->count(),
      'experts' => collect($this->experts->pluck('fullname')->all())->implode(', '),
      'is_confirmed' => $this->is_confirmed,
      'confirmed_at' => $this->confirmed_at,
      'is_cancelled' => $this->is_cancelled,
      'cancelled_at' => $this->cancelled_at,
      'is_closed' => $this->is_closed,
      'closed_at' => $this->closed_at,
      'is_past' => $this->is_past,
      'is_upcoming' => $this->is_upcoming,
    ];
  }
}
