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
      'pending' => Invoice::with('user', 'booking')->pending()->orderBy('number', 'DESC')->get(),
      'paid' => Invoice::with('user', 'booking')->paid()->get(),
      'cancelled' => Invoice::with('user', 'booking')->cancelled()->get(),
    ]);

  }

}
