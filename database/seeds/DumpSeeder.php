<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DumpSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    \Artisan::call('db:wipe');

    $sql = public_path('/dumps/viakch.sql');
    $db = [
        'username' => env('DB_USERNAME'),
        'password' => env('DB_PASSWORD'),
        'host' => env('DB_HOST'),
        'database' => env('DB_DATABASE'),
        'socket' => env('DB_SOCKET')
    ];

    if (app()->environment() == 'local')
    {
      exec("mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database {$db['database']} --socket {$db['socket']} < $sql");
    }
    else
    {
      exec("mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database {$db['database']} < $sql");
    }

    \Log::info('SQL Import Done');
  }
}
