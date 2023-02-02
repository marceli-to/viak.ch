<?php
namespace App\Tasks;
use App\Models\Invoice;
use App\Actions\Invoice\UpdateInvoiceStatus;
use App\Actions\RMA\GetInvoiceStatus;
use Illuminate\Support\Facades\Log;

class RunInvoiceBatchProcess
{
  public function __invoke()
  {
    $invoice = Invoice::queued()->first();
    if ($invoice)
    {
      $status = (new GetInvoiceStatus())->execute($invoice);
    
      if ($status)
      {
        (new UpdateInvoiceStatus())->execute($invoice, $status);
        Log::info('updated status to: ' . $status);
      }
      // just for debugging purposes
      else
      {
        Log::info('no status available for invoice no.: ' . $invoice->number);
      }
      $invoice->queued = 0;
      $invoice->save();
      Log::info('removed from queue');
    }
  }
}