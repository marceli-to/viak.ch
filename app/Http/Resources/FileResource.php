<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
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
      'original_name' => $this->original_name,
      'name' => $this->name,
      'description' => $this->description,
      'extension' => $this->extension,
      'size' => $this->size,
      'uploaded_at' => $this->uploaded_at,
      'belongs_to_message' => $this->messages->count() > 0 ? true : false
    ];
  }
}
