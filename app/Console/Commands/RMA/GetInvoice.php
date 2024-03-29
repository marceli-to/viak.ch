<?php
namespace App\Console\Commands\RMA;
use App\Models\Invoice;
use App\Actions\RMA\GetInvoice as GetInvoiceAction;
use Illuminate\Console\Command;

class GetInvoice extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'get:invoice';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Get an invoice from run my accounts';

  protected $getInvoiceAction;

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct(GetInvoiceAction $getInvoiceAction)
  {
    $this->getInvoiceAction = $getInvoiceAction;
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
    $askCancellation = $this->ask('Add cancellation suffix? (y/n)');
    $askCancellation = $askCancellation == 'y' ? TRUE : FALSE;
    $invoice = Invoice::with('user')->where('number', 'LIKE', "%$askInvoiceNumber%")->first();
    $response = $this->getInvoiceAction->execute($invoice, $askCancellation);
    
    dd($response);
  }
}
