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
      'date' => $this->date,
      'registration_until' => $this->registration_until,
      'min_participants' => $this->min_participants,
      'max_participants' => $this->max_participants,
      'online' => $this->online,
      'fee' => $this->fee,
      'publish' => $this->publish,
      //'course' => CourseResource::make($this->course),
      'location' => LocationResource::make($this->location),
      'dates' => $this->dates->map(function($date) {
        return [
          'date' => $date->date,
          'date_short' => $date->date_short,
          'time_start' => $date->time_start,
          'time_end' => $date->time_end,
        ];
      }),
      'bookings' => $this->bookings->count(),
      'experts' => collect($this->experts->pluck('fullname')->all())->implode(', '),
      'confirmed' => $this->confirmed,
      'confirmed_at' => $this->confirmed_at,
      'cancelled' => $this->cancelled,
      'cancelled_at' => $this->cancelled_at,
    ];
  }
}
