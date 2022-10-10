<?php
namespace App\Services\Pdf\Invoice;
use PDF as DomPDF;
use App\Services\Pdf\Invoice\Qr;
use App\Models\Invoice;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EventInvoice
{
  protected $storageFolder;

  public function __construct()
  {
    $this->storageFolder = public_path() . '/storage/files/';
    if (!File::isDirectory(storage_path('app/public/files')))
    {
      File::makeDirectory(storage_path('app/public/files'), 0775, true, true);
    }
  }

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
    $this->viewData['invoice']    = $invoice;
    $this->viewData['qr'] = (new Qr($invoice->number, 0, $invoice->grand_total))->get();

    // Load view and save file to disk
    $pdf = DomPDF::loadView('pdf.invoice.event-invoice', $this->viewData);
    $file = 'viak-rechnung-' . date('dmY', time()) . '-' . $invoice->number . '.pdf';
    $pdf->save($this->storageFolder . $file);
    
    return [
      'path' => $this->storageFolder . $file,
      'name' => $file
    ];
  }

  
}