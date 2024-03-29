<?php
namespace App\Http\Resources;
use App\Http\Resources\BookingResource;
use App\Http\Resources\BookmarkResource;
use App\Http\Resources\UserAddressResource;
use App\Http\Resources\StudentDocumentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{

  protected $appendAllData = false;

  /**
   * Allow documents to be appended
   */
  public function withAllData(bool $value = false)
  {
    $this->appendAllData = $value;
    return $this;
  }

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
      'company' => $this->company,
      'fullname' => $this->fullname,
      'firstname' => $this->firstname,
      'name' => $this->name,
      'address' => $this->address,
      'street' => $this->street,
      'street_no' => $this->street_no,
      'zip' => $this->zip,
      'city' => $this->city,
      'phone' => $this->phone,
      'invoice_addresses' => UserAddressResource::collection($this->invoiceAddresses),
      'operating_system' => $this->operating_system,
      'subscribe_newsletter' => $this->subscribe_newsletter,
      'email' => $this->email,
      'gender_id' => $this->gender_id,
      'country_id' => $this->country_id,
      $this->mergeWhen($this->appendAllData, [
        'events' => BookingResource::collection($this->bookings)->sortBy('event.date')->toArray(),
        'events_participated' => BookingResource::collection($this->bookingsParticipated)->sortBy('event.date')->toArray(),
        'events_concluded' => BookingResource::collection($this->bookingsConcluded)->sortBy('event.date')->toArray(),
        'bookmarks' => BookmarkResource::collection($this->bookmarks),
        'documents' => StudentDocumentResource::collection($this->documents()->take(5)->get()),
      ]),
    ];
  }
}
