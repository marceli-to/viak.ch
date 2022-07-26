<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Database\Seeder;
use Faker\Generator;

class StudentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faker = \Faker\Factory::create();

    // Test student
    $user = User::create([
      'firstname' => 'Paul',
      'name' => 'Mosimann',
      'street' => 'Letzigraben',
      'street_no' => '149',
      'zip' => '8047',
      'city' => 'Zürich',
      'phone' => '078 749 74 09',
      'email' => 'viak-student@0704.ch',
      'email_verified_at' => \Carbon\Carbon::now(),
      'password' => \Hash::make('7aq31rr23'),
      'uuid' => \Str::uuid(),
      'gender_id' => 1,
      'visible' => 1,
    ]);

    RoleUser::create([
      'role_id' => 3,
      'user_id' => $user->id
    ]);

    for($i = 0; $i<=20; $i++)
    {
      $user = User::create([
        'firstname' => $faker->firstName,
        'name' => $faker->lastName,
        'email' => $faker->unique()->email(),
        'email_verified_at' => \Carbon\Carbon::now(),
        'password' => \Hash::make('*poLksmBv$!)('),
        'uuid' => \Str::uuid(),
        'gender_id' => rand(1,2)
      ]);

      RoleUser::create([
        'role_id' => 3,
        'user_id' => $user->id
      ]);

    }
  }
}
