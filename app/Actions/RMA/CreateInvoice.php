<?php
namespace App\Actions\RMA;
use Illuminate\Support\Facades\Http;
use App\Models\Invoice;
use App\Services\Pdf\Invoice\Qr;

class CreateInvoice
{
  public function execute(Invoice $invoice, $isCancellation = FALSE)
  {
    $headers = [
      'content-type' => 'application/json',
      'accept' => 'application/json'
    ];

    // invoice name prefix
    // $inv_prefix = 'viak-rechnung-';
    
    // // invoice date (dd-mm-yyyy)
    // $inv_date = \Carbon\Carbon::parse($invoice->date)->format('d-m-Y');

    // // invoice number
    // $inv_number = $invoice->number;

    // // invoice name
    // $inv_name = $inv_prefix . $inv_date . '-' . $inv_number . '.pdf';

    // Get ESR Data from QR Invoice Slip
    $esr_data = (new Qr($invoice))->get();

    // Get url to invoice pdf
    $invoice_url = config('app.url') . "/storage/files/" . $invoice->user?->uuid . "/" . $invoice->filename;
    
    // Build invoice number, add 'cancellation suffix' if needed
    $invoice_number = $isCancellation ? 
                      config('invoice.prefix') . $invoice->number .  config('invoice.cancellation_suffix') : 
                      config('invoice.prefix') . $invoice->number;
    // Build data
    $data = [
      "invnumber" => $invoice_number,
      "ordnumber" => $invoice->booking?->number,
      "dcn" => str_replace(' ', '', $esr_data['reference_number']),
      "currency" => "CHF",
      "ar_accno" => "1100",
      "transdate" => \Carbon\Carbon::parse($invoice->date)->toIso8601String(),
      "duedate" => \Carbon\Carbon::parse($invoice->date)->addDays(config('invoice.payment_period'))->toIso8601String(),
      "description" => $invoice->booking?->event?->course?->title . ' (<a href="'. $invoice_url .'" target="_blank">Rechnung</a>)',
      "notes" => "", 
      "intnotes" => $invoice->filename,
      "taxincluded" => "false", 
      "customer" => [
        "customernumber" => config('invoice.prefix') . $invoice->user?->id,
        "name" => $invoice->user?->fullname,
      ],
      "incomeentries" => [
        "incomeentry" => [
          "amount" => $isCancellation ? "-" . $invoice->grand_total : $invoice->grand_total,
          "income_accno" => "3400",
          "description" => ""
        ]
      ],
      "taxentries" => [
        "taxentry" => [
          "amount" => "0.00",
          "tax_accno" => "2201"
        ]
      ]
    ];

    if (app()->environment() == 'production')
    {
      return Http::withHeaders([
        'content-type' => 'application/json',
        'accept' => 'application/json'
      ])->post(env('RMA_ROUTE_API_BASE') . env('RMA_ROUTE_API_CREATE'), $data);
    }
    return TRUE;
  }
}