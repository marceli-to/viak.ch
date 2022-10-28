<?php

namespace App\Events;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Invoice;
use App\Facades\ParticipantsChange;

class InvoicePaid
{
  use Dispatchable, SerializesModels;

  public $invoice;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct(Invoice $invoice)
  {
    $this->invoice = Invoice::with('booking.event.course', 'user')->find($invoice->id);
  }
}
