<?php
namespace App\Http\Resources\Dashboard;
use App\Http\Resources\Dashboard\EventResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
      'number' => $this->number,
      'course_number' => $this->course_number,
      'title' => $this->title,
      'subtitle' => $this->subtitle,
      'fee' => $this->fee,
      'online' => $this->online,
      'publish' => $this->publish,
      'count' => collect($this->upcomingEvents)->count(),
      'events' => EventResource::collection($this->upcomingEvents)->sortByDesc('date'),
    ];
  }
}
