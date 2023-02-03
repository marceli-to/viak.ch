<?php
namespace App\Actions\RMA;
use Illuminate\Support\Facades\Http;
use App\Models\Invoice;

class UpdateInvoiceStatusToPaid
{
  public function execute(Invoice $invoice)
  {
    $data = [
      "datepaid" => \Carbon\Carbon::now()->toIso8601String(),
      "amount_paid" => $invoice->grand_total,
      "memo" => "Zahlung via Kreditkarte",
      "payment_accno" => "1107"
    ];

    $url = env('RMA_ROUTE_API_BASE') . str_replace('%INVOICE_NO%', config('invoice.prefix') . $invoice->number, env('RMA_ROUTE_API_UPDATE'));

    return Http::withHeaders([
      'content-type' => 'application/json',
      'accept' => 'application/json'
    ])->post($url, $data);

  }
}