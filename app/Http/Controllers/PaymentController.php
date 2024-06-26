<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Booking;
use App\Models\Invoice;
use App\Events\InvoicePaid;
use App\Stores\PaymentStore;
use App\Actions\RMA\UpdateInvoiceStatusToPaid as UpdateInvoiceStatusToPaidAction;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{
  protected $viewPath = 'web.pages.payment.';

  /**
   * Show the invoice / booking
   * @param Invoice $invoice
   * @return \Illuminate\Http\Response
   */

  public function index(Invoice $invoice)
  {
    $this->authorize('view', $invoice->booking);
    $invoice = invoice::with('booking.user')->findOrFail($invoice->id);

    if ($invoice->isPaid())
    {
      return view($this->viewPath . 'info', ['invoice' => $invoice]);
    }

    return view($this->viewPath . 'index', ['booking' => $invoice->booking, 'invoice' => $invoice]);
  }

  /**
   * Create a stripe checkout session
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    // Get the invoice
    $invoice = Invoice::with('booking.user')->where('uuid', $request->input('invoice'))->firstOrFail();

    if ($invoice->isPaid())
    {
      return view($this->viewPath . 'info', ['invoice' => $invoice]);
    }

    // save invoice to store
    $store = (new PaymentStore())->setAttribute('invoice_uuid', $invoice->uuid);

    $items[] = [
      'price_data' => [
        'currency' => 'chf',
        'unit_amount' => (int) ($invoice->grand_total * 100),
        'product_data' => [
          'name' => $invoice->booking->event->course->title . ", " . collect($invoice->booking->event->dates->pluck('date_short')->all())->implode(', '),
        ],
      ],
      'quantity' => 1,
    ];

    // Setup stripe payment
    \Stripe\Stripe::setApiKey(env('PAYMENT_STRIPE_PRIVATE_KEY'));
    $domain = config('app.url');

    // Create checkout session id
    $checkout_session = \Stripe\Checkout\Session::create([
      'customer_email' => $invoice->booking->user->email,
      'submit_type' => 'pay',
      'payment_method_types' => ['card'],
      'line_items' => $items,
      'mode' => 'payment',
      'locale' => app()->getLocale(),
      'success_url' => route(locale() . '.page.payment.success'),
      'cancel_url' => route(locale() . '.page.payment.cancel'),
    ]);
    return redirect()->away($checkout_session->url);
  }

  /**
   * Show the payment success page
   *
   * @param  Request $request
   * @return \Illuminate\Http\Response
   */

  public function success()
  {
    $invoice_uuid = (new PaymentStore())->getAttribute('invoice_uuid');

    // Abort if uuid is missing
    if (!$invoice_uuid)
    {
      // Log error
      \Log::error('Payment success page called without invoice uuid');
      abort(403);
    }

    // Update invoice
    $invoice = Invoice::where('uuid', $invoice_uuid)->firstOrFail();
    $invoice->status = 'PAID';
    $invoice->paid_at = \Carbon\Carbon::now();
    $invoice->save();

    // Update invoice in Run My Accounts
    if (app()->environment() == 'production')
    {
      (new UpdateInvoiceStatusToPaidAction())->execute($invoice);
    }

    // Clear session
    (new PaymentStore())->clear();

    // Send notifications
    event(new InvoicePaid($invoice));

    return view($this->viewPath . 'success', ['invoice' => $invoice]);
  }

  /**
   * Show the payment cancel page
   *
   * @param  Request $request
   * @return \Illuminate\Http\Response
   */

  public function cancel()
  {
    (new PaymentStore())->clear();
    return view($this->viewPath . 'cancel');
  }
}
