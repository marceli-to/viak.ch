<?php
namespace App\Console\Commands;
use App\Models\Invoice;
use App\Services\PDF\Invoice\EventInvoice;
use Illuminate\Console\Command;

class GenerateInvoice extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'generate:invoice';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Generates an invoice pdf';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    // ask for invoice number
    $searchTerm = $this->ask('Enter invoice number: ');

    // find invoice
    $invoice = Invoice::where('number', 'LIKE', "%$searchTerm%")->first();

    // generate invoice pdf
    (new EventInvoice())->create($invoice);

    $this->info('The command was successful!');
  }
}
