<?php
namespace App\Http\Resources;
use App\Helpers\PenaltyHelper;
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
      'uuid' => $this->uuid,
      'date' => $this->date,
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
      'cancellation' => PenaltyHelper::get($this->date, $this->courseFee),
    ];
  }
}
