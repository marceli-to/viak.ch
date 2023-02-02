<?php
namespace App\Actions\RMA;
use Illuminate\Support\Facades\Http;
use App\Models\Invoice;

class GetInvoice
{
  public function execute(Invoice $invoice)
  {
    $url = env('RMA_ROUTE_API_BASE') . str_replace('%INVOICE_NO%', config('invoice.prefix') . $invoice->number, env('RMA_ROUTE_API_GET'));
    $response = Http::acceptJson()->get($url);
    if ($response->status() == 200)
    {
      return $response->object();
    }
    return NULL;
  }
}