<?php
namespace App\Http\Resources;
use App\Http\Resources\BookingResource;
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
      'uuid' => $this->uuid,
      'title' => $this->title,
      'subtitle' => $this->subtitle,
      'text' => $this->text,
      'online' => $this->online,
      'fee' => $this->fee
    ];
  }
}
