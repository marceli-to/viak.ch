<?php
namespace App\Services\Pdf\Invoice;
use PDF as DomPDF;
use App\Services\Pdf\Invoice\Qr;
use App\Models\Invoice;
use App\Models\UserDocument;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EventInvoice
{
  protected $storagePath;
  protected $storageUri;

  /**
   * Create an Invoice
   * 
   * @param Invoice $invoice
   * @return Array
   */

  public function create(Invoice $invoice)
  {
    // Invoice with relations
    $invoice = $invoice->with('booking.event.course', 'booking.user')->find($invoice->id);

    // Set view data
    $this->viewData['invoice'] = $invoice;
    $this->viewData['qr'] = (new Qr($invoice))->get();

    // Set storage folder
    $this->setStoragePath($invoice->user->uuid);
    $this->setStorageUri($invoice->user->uuid);

    // Load view and save file to disk
    $pdf = DomPDF::loadView('pdf.invoice.event-invoice', $this->viewData);
    $fileName = 'viak-rechnung-' . date('d-m-Y', time()) . '-' . $invoice->number . '.pdf';
    $pdf->save($this->storagePath . '/' . $fileName);
    
    // Add to user documents
    UserDocument::create([
      'uuid' => \Str::uuid(),
      'date' => $invoice->date,
      'name' => $fileName,
      'type' => 'INVOICE',
      'uri' =>   $this->storageUri . '/' . $fileName,
      'user_id' => $invoice->user->id,
      'fileable_type' => "App\Models\Invoice",
      'fileable_id' => $invoice->id
    ]);

    return [
      'uri' => public_path() . $this->storageUri . '/' . $fileName,
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
    $this->storageUri = "/storage/files/{$userUuid}";
  }
    
}