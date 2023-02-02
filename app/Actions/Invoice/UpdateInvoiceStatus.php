<?php
namespace App\Actions\Invoice;
use App\Models\Invoice;

class UpdateInvoiceStatus
{
  public function execute(Invoice $invoice, $status)
  {
    $invoice->status = $status;
    if ($status == 'PAID')
    {
      $invoice->paid_at = \Carbon\Carbon::now();
    }
    $invoice->save();
    return $invoice->status;
  }
}