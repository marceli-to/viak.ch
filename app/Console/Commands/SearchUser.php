<?php
namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;

class SearchUser extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'search:user {email}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Search a user by email';

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
    // Get users
    $user = User::where('email', 'like', $this->argument('email'))->first();

    if ($user)
    {
      $this->info('User found');
      $this->info(dd($user));
    }
  }
}
