<?php
namespace App\Console\Commands;
use App\Models\User;
use function Termwind\{ask, render};
use Illuminate\Console\Command;

class UsersAnonymize extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'users:anonymize';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Anonymize users table';

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
  public function handle(): int
  {
    $users = User::all();
    foreach($users as $user)
    {
      if (!$user->isAdmin())
      {
        $user->email = uniqid() . '@example.com';
        $user->save();
      }
    }
    return self::SUCCESS;
  }
}
