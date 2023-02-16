<?php
namespace App\Services\Pdf;
use PDF as DomPDF;
use App\Models\Booking;
use App\Models\UserDocument;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EventParticipationConfirmation
{
  protected $storagePath;
  protected $storageUri;

  /**
   * Create a event participation confirmation
   * 
   * @param Booking $booking
   * @return Array
   */

  public function create(Booking $booking)
  {
    // Invoice with relations
    $booking = $booking->with('event.course', 'user')->find($booking->id);

    // Set view data
    $this->viewData['booking'] = $booking;

    // Set file name
    $fileName = 'viak-teilnahmebestaetigung-' . date('d-m-Y', time()) . '-' . $booking->number . '.pdf';

    // Set storage folder
    $this->setStoragePath($booking->user->uuid);
    $this->setStorageUri($booking->user->uuid);

    // Load view and save file to disk
    $pdf = DomPDF::loadView('pdf.course.participant-confirmation', $this->viewData);
    $pdf->save($this->storagePath . '/' . $fileName);
    
    // Add to user documents
    UserDocument::create([
      'uuid' => \Str::uuid(),
      'date' => $booking->event->closed_at,
      'name' => $fileName,
      'type' => 'PARTICIPATION_CONFIRMATION',
      'uri' =>   $this->storageUri . '/' . $fileName,
      'user_id' => $booking->user->id,
      'fileable_type' => "App\Models\Booking",
      'fileable_id' => $booking->id
    ]);

    return [
      'uri' => storage_path() . $this->storageUri . '/' . $fileName,
      'path' => $this->storagePath . '/' . $fileName,
      'filename' => $fileName
    ];
  }

  protected function getStoragePath()
  {
    return $this->storagePath;
  }

  protected function setStoragePath($userUuid)
  {
    $userDirectory = storage_path('app/public/files') . '/' . $userUuid;
    if (!File::isDirectory($userDirectory))
    {
      File::makeDirectory($userDirectory, 0775, true, true);
    }
    $this->storagePath = $userDirectory;
  }

  protected function getStorageUri($userUuid)
  {
    return $this->storageUri;
  }

  protected function setStorageUri($userUuid)
  {
    $this->storageUri = "/app/public/files/{$userUuid}";
  }
  
}