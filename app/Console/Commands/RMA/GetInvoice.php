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
    $searchTerm = $this->ask('Enter invoice number: ');
    $invoice = Invoice::with('user')->where('number', 'LIKE', "%$searchTerm%")->first();
    $response = $this->getInvoiceAction->execute($invoice);
    dd($response);
  }
}
