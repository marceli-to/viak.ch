<?php
namespace App\Console\Commands\RMA;
use App\Models\Invoice;
use App\Actions\RMA\CreateInvoice as CreateInvoiceAction;
use Illuminate\Console\Command;

class CreateInvoice extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'create:invoice';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create an invoice in Run My Accounts';

  protected $createInvoiceAction;

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct(CreateInvoiceAction $createInvoiceAction)
  {
    $this->createInvoiceAction = $createInvoiceAction;
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
    $invoice = Invoice::with('booking', 'user')->where('number', 'LIKE', "%$searchTerm%")->first();
    $response = $this->createInvoiceAction->execute($invoice);
  }
}
