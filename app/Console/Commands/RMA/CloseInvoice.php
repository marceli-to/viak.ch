<?php
namespace App\Console\Commands\RMA;
use App\Models\Invoice;
use App\Actions\RMA\CloseInvoice as CloseInvoiceAction;
use Illuminate\Console\Command;

class CloseInvoice extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'close:invoice';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Close an invoice in Run My Accounts';

  protected $closeInvoiceAction;

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct(CloseInvoiceAction $closeInvoiceAction)
  {
    $this->closeInvoiceAction = $closeInvoiceAction;
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $askInvoiceNumber = $this->ask('Enter invoice number: ');
    $askCancellation = $this->ask('Use a negative value? (y/n)');
    $askCancellation = $askCancellation == 'y' ? TRUE : FALSE;
    $invoice = Invoice::with('booking', 'user')->where('number', 'LIKE', "%$askInvoiceNumber%")->first();
    $response = $this->closeInvoiceAction->execute($invoice, $askCancellation);
    dd($response);
  }
}
