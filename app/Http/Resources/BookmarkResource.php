<?php
namespace App\Http\Resources;
use App\Http\Resources\EventResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookmarkResource extends JsonResource
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
      'event' => EventResource::make($this->event),
    ];
  }
}
