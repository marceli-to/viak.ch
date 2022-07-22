<?php
namespace App\Services\Pdf;
use PDF as DomPDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Services\Pdf\Pdf as PdfService;
use App\Services\Pdf\Qr;

class Invoice extends PdfService
{
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Create an Invoice
   * 
   * @return Array
   */

  public function create($opts = array())
  {
    $data['invoice_total'] = $opts['amount'];
    $data['invoice_number'] = $opts['number'];

    // Set view data
    $this->viewData['data']   = $data;
    $this->viewData['data_qr'] = (new Qr($data['invoice_number'], 0, $data['invoice_total']))->get();

    // Load view and save file to disk
    $pdf = DomPDF::loadView('pdf.invoice.invoice', $this->viewData);
    $file = 'viak-rechnung-' . date('dmY', time()) . '-' . \Str::random(12) . '.pdf';
    $pdf->save(public_path() . '/storage/temp/' . $file);
    
    return [
      'path' => public_path() . '/storage/temp/' . $file,
      'name' => $file
    ];
  }
}