<?php
namespace App\Actions\RMA;
use Illuminate\Support\Facades\Http;
use App\Models\Invoice;
use App\Services\Pdf\Invoice\Qr;

class CreateInvoice
{
  public function execute(Invoice $invoice)
  {

    $headers = [
      'content-type' => 'application/json',
      'accept' => 'application/json'
    ];

    // Get ESR Data from QR Invoice Slip
    $esr_data = (new Qr($invoice))->get();

    // Get url to invoice pdf
    $invoice_url = env('APP_URL') . "/storage/files/" . $invoice->user?->uuid . "/" . $invoice->filename;
   
    // Create data
    $data = [
      "invnumber" => "VIAK_" . $invoice->number,
      "ordnumber" => $invoice->booking?->number,
      "dcn" => str_replace(' ', '', $esr_data['reference_number']),
      "currency" => "CHF",
      "ar_accno" => "1100",
      "transdate" => \Carbon\Carbon::parse($invoice->date)->toIso8601String(),
      "duedate" => \Carbon\Carbon::parse($invoice->date)->addDays(config('invoice.payment_period'))->toIso8601String(),
      "description" => $invoice->booking?->event?->course?->title . ' (<a href="'. $invoice_url .'" target="_blank">Rechnung</a>)',     
      "notes" => "", 
      "intnotes" => "",
      "taxincluded" => "false", 
      "customer" => [
        "customernumber" => "VIAK_" . $invoice->user?->id,
        "name" => $invoice->user?->fullname,
      ],
      "incomeentries" => [
        "incomeentry" => [
          "amount" => $invoice->grand_total,
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

    $url = env('RMA_ROUTE_API_BASE') . env('RMA_ROUTE_API_POST');

    return Http::withHeaders([
      'content-type' => 'application/json',
      'accept' => 'application/json'
    ])->post($url, $data);
  }

}