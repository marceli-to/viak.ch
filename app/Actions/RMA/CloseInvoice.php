<?php
namespace App\Actions\RMA;
use Illuminate\Support\Facades\Http;
use App\Models\Invoice;

class CloseInvoice
{
  public function execute(Invoice $invoice, $isCancellation = FALSE)
  {
    // Build invoice number, add 'cancellation suffix' if needed
    $invoice_number = $isCancellation ? 
                      config('invoice.prefix') . $invoice->number .  config('invoice.cancellation_suffix') : 
                      config('invoice.prefix') . $invoice->number;

    $data = [
      "datepaid" => \Carbon\Carbon::now()->toIso8601String(),
      "amount_paid" => $isCancellation ? "-" . $invoice->grand_total : $invoice->grand_total,
      "memo" => "STORNO",
      "payment_accno" => "1090"
    ];

    if (app()->environment() == 'production')
    {
      $url = env('RMA_ROUTE_API_BASE') . str_replace('%INVOICE_NO%', $invoice_number, env('RMA_ROUTE_API_UPDATE'));

      return Http::withHeaders([
        'content-type' => 'application/json',
        'accept' => 'application/json'
      ])->post($url, $data);
    }
    return TRUE;

  }
}