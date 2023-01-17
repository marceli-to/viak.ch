<?php
namespace App\Console\Commands;
use App\Models\User;
use function Termwind\{ask, render};
use Illuminate\Console\Command;

class UsersSearch extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'users:search';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Search for users in the system';

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
    $searchTerm = ask(<<<HTML
      <span class="mt-1 ml-2 mr-1 bg-green px-1 text-black">
        Search term:
      </span>
    HTML);

    $users = User::search($searchTerm);

    $rows = $users->map(fn (User $user): array => [
      $user->firstname,
      $user->name,
      $user->company,
      $user->email,
      $user->email_verified_at ?? 'No!',
    ])->all();

    render(
      view('cli.user-search', ['users' => $users])
    );

    return self::SUCCESS;
  }
}
