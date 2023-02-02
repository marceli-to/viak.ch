<?php
namespace App\Tasks;
use App\Models\Invoice;

class PrepareInvoiceBatchProcess
{
  public function __invoke()
  {
    Invoice::pending()->update(['queued' => 1]);
  }
}