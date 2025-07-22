<?php
namespace App\Actions\RMA;
use Illuminate\Support\Facades\Http;
use App\Models\Invoice;

class GetInvoice
{
  public function execute(Invoice $invoice, $isCancellation = FALSE)
  {
    // Build invoice number, add 'cancellation suffix' if needed
    $invoice_number = $isCancellation ? 
                      config('invoice.prefix') . $invoice->number .  config('invoice.cancellation_suffix') : 
                      config('invoice.prefix') . $invoice->number;

    if (app()->environment() == 'production')
    {
      $url = env('RMA_ROUTE_API_BASE') . str_replace('%INVOICE_NO%', $invoice_number, env('RMA_ROUTE_API_GET'));
      $response = Http::acceptJson()->get($url);
      if ($response->status() == 200)
      {
        return $response->object();
      }
    }
    return NULL;
  }
}