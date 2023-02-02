<?php
namespace App\Console\Commands\RMA;
use App\Models\Invoice;
use App\Actions\RMA\UpdateInvoiceStatusToPaid as UpdateInvoiceStatusToPaid;
use Illuminate\Console\Command;

class UpdateInvoice extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'update:invoice';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Updates an invoice in Run My Accounts';

  protected $updateInvoiceStatusToPaid;

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct(UpdateInvoiceStatusToPaid $updateInvoiceStatusToPaid)
  {
    $this->updateInvoiceStatusToPaid = $updateInvoiceStatusToPaid;
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
    $response = $this->updateInvoiceStatusToPaid->execute($invoice);
    dd($response->object());
  }
}
