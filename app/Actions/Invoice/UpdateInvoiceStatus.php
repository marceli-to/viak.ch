<?php
namespace App\Actions\Invoice;
use App\Models\Invoice;

class UpdateInvoiceStatus
{
  public function execute(Invoice $invoice, $status)
  {
    $invoice->status = $status;
    $invoice->save();
    return $invoice->status;
  }
}