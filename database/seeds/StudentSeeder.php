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

    for($i = 0; $i<=50; $i++)
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
