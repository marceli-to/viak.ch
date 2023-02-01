<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\Invoice;
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

}
