<?php
namespace App\Http\Resources;
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
    $data = [
      'uuid' => $this->uuid,
      'date' => $this->date_long,
      'online' => $this->online,
      'fee' => $this->courseFee,
      'course' => CourseResource::make($this->course),
      'location' => LocationResource::make($this->location),
      'dates' => $this->dates->map(function($date) {
        return [
          'date' => $date->date,
          'date_short' => $date->date_short,
          'time_start' => $date->time_start,
          'time_end' => $date->time_end,
        ];
      }),
      'experts' => collect($this->experts->pluck('fullname')->all())->implode(', '),
      'is_confirmed' => $this->hasFlag('isConfirmed'),
      'is_closed' => $this->hasFlag('isClosed'),
      'is_cancelled' => $this->hasFlag('isCancelled'),
    ];

    // Additional data for role 'Expert' or 'Admin'
    if (auth()->user()->isExpert() || auth()->user()->isAdmin())
    {
      $data['bookings'] = collect($this->bookings)->count();
      $data['min_participants'] = $this->min_participants;
      $data['max_participants'] = $this->max_participants;
      $data['confirmed_at'] = $this->confirmed_at;
      $data['cancelled_at'] = $this->cancelled_at;
      $data['closed_at'] = $this->closed_at;
    }

    return $data;
  }
}
