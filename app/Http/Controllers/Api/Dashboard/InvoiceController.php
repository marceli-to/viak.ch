<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\Invoice;
use App\Services\Pdf\Invoice\EventInvoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
  /**
   * Get a list of invoices
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return response()->json([
      'open' => Invoice::with('user', 'booking')->open()->orderBy('number', 'DESC')->get(),
      'paid' => Invoice::with('user', 'booking')->paid()->orderBy('number', 'DESC')->get(),
      'cancelled' => Invoice::with('user', 'booking')->cancelled()->orderBy('number', 'DESC')->get(),
      'overdue' => Invoice::with('user', 'booking')->overdue()->orderBy('number', 'DESC')->get(),
    ]);
  }

  /**
   * Get a single invoice
   * 
   * @param Invoice $invoice
   * @return \Illuminate\Http\Response
   */
  public function find(Invoice $invoice)
  {
    return response()->json(
      Invoice::with('user', 'booking')->find($invoice->id)
    );
  }

  /**
   * Update an invoice
   *
   * @param Invoice $invoice
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function update(Invoice $invoice, Request $request)
  {
    $invoice = Invoice::findOrFail($invoice->id);
    $invoice->update($request->all());
    (new EventInvoice())->update($invoice);

    return response()->json('successfully updated');
  }
}
