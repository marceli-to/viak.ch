<?php
namespace App\Console\Commands\RMA;
use App\Models\Invoice;
use App\Actions\RMA\GetInvoiceStatus as GetInvoiceStatusAction;
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
  protected $description = 'Get the state of an invoice from run my accounts';

  protected $getInvoiceStatusAction;

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct(GetInvoiceStatusAction $getInvoiceStatusAction)
  {
    $this->getInvoiceStatusAction = $getInvoiceStatusAction;
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle(): mixed
  {
    $searchTerm = $this->ask('Enter invoice number: ');
    $invoice = Invoice::with('user')->where('number', 'LIKE', "%$searchTerm%")->first();
    return $this->getInvoiceStatusAction->execute($invoice);
  }
}
