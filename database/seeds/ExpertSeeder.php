<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Database\Seeder;
use Faker\Generator;

class ExpertSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faker = \Faker\Factory::create();

    // Test expert
    $user = User::create([
      'firstname' => 'Peter',
      'name' => 'Muster',
      'company' => 'Muster AG',
      'email' => 'viak-experte@0704.ch',
      'email_verified_at' => \Carbon\Carbon::now(),
      'password' => \Hash::make('7aq31rr23'),
      'uuid' => \Str::uuid(),
      'gender_id' => 1,
      'visible' => 1,
    ]);

    RoleUser::create([
      'role_id' => 2,
      'user_id' => $user->id
    ]);

    for($i = 0; $i<=9; $i++)
    {
      $user = User::create([
        'firstname' => $faker->firstName,
        'name' => $faker->lastName,
        'company' => $faker->company,
        'email' => $faker->unique()->email(),
        'email_verified_at' => \Carbon\Carbon::now(),
        'password' => \Hash::make('*poLksmBv$!)('),
        'uuid' => \Str::uuid(),
        'gender_id' => rand(1,2),
        'visible' => 1,
      ]);

      RoleUser::create([
        'role_id' => 2,
        'user_id' => $user->id
      ]);

    }
  }
}
