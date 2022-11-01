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

    // Test student 1
    $user = User::create([
      'firstname' => 'Patrick',
      'name' => 'Schneider',
      'company' => 'Acme Inc',
      'street' => 'Breitestrasse',
      'street_no' => '9',
      'zip' => '8400',
      'city' => 'Winterthur',
      'phone' => '077 755 55 00',
      'email' => 'viak-student1@0704.ch',
      'email_verified_at' => \Carbon\Carbon::now(),
      'password' => \Hash::make('7aq31rr23'),
      'uuid' => \Str::uuid(),
      'gender_id' => 1,
      'country_id' => 1,
      'visible' => 1,
    ]);

    RoleUser::create([
      'role_id' => 3,
      'user_id' => $user->id
    ]);

    // Test student 2
    $user = User::create([
      'firstname' => 'Michel',
      'name' => 'Blanc',
      'company' => '',
      'street' => 'Dorfstrasse',
      'street_no' => '12',
      'zip' => '5400',
      'city' => 'Remigen',
      'phone' => '076 642 01 04',
      'email' => 'viak-student2@0704.ch',
      'email_verified_at' => \Carbon\Carbon::now(),
      'password' => \Hash::make('7aq31rr23'),
      'uuid' => \Str::uuid(),
      'gender_id' => 1,
      'country_id' => 1,
      'visible' => 1,
    ]);

    RoleUser::create([
      'role_id' => 3,
      'user_id' => $user->id
    ]);

    // Test student 3
    $user = User::create([
      'firstname' => 'Raphael',
      'name' => 'Bichsel',
      'company' => 'Bichsel Flugzeugwerke GmbH',
      'street' => 'Konrudstrasse',
      'street_no' => '4a',
      'zip' => '8400',
      'city' => 'Winterthur',
      'phone' => '077 870 09 20',
      'email' => 'viak-student3@0704.ch',
      'email_verified_at' => \Carbon\Carbon::now(),
      'password' => \Hash::make('7aq31rr23'),
      'uuid' => \Str::uuid(),
      'gender_id' => 1,
      'country_id' => 1,
      'visible' => 1,
    ]);

    RoleUser::create([
      'role_id' => 3,
      'user_id' => $user->id
    ]);

    // Test student 4
    $user = User::create([
      'firstname' => 'Balint',
      'name' => 'Kalotay',
      'company' => '',
      'street' => 'Billrothstrasse',
      'street_no' => '5',
      'zip' => '8000',
      'city' => 'Zürich',
      'phone' => '077 888 88 88',
      'email' => 'viak-student4@0704.ch',
      'email_verified_at' => \Carbon\Carbon::now(),
      'password' => \Hash::make('7aq31rr23'),
      'uuid' => \Str::uuid(),
      'gender_id' => 1,
      'country_id' => 1,
      'visible' => 1,
    ]);

    RoleUser::create([
      'role_id' => 3,
      'user_id' => $user->id
    ]);


    // Test student 5
    $user = User::create([
      'firstname' => 'Gabriela',
      'name' => 'Morf',
      'company' => '',
      'street' => 'Letzigraben',
      'street_no' => '149',
      'zip' => '8047',
      'city' => 'Zürich',
      'phone' => '077 666 55 88',
      'email' => 'viak-student5@0704.ch',
      'email_verified_at' => \Carbon\Carbon::now(),
      'password' => \Hash::make('7aq31rr23'),
      'uuid' => \Str::uuid(),
      'gender_id' => 2,
      'country_id' => 1,
      'visible' => 1,
    ]);

    RoleUser::create([
      'role_id' => 3,
      'user_id' => $user->id
    ]);

    // Test student 5
    $user = User::create([
      'firstname' => 'Mats',
      'name' => 'Thommen',
      'company' => '',
      'street' => 'Feldstrasse',
      'street_no' => '33',
      'zip' => '8400',
      'city' => 'Winterthur',
      'phone' => '079 456 21 21',
      'email' => 'viak-student6@0704.ch',
      'email_verified_at' => \Carbon\Carbon::now(),
      'password' => \Hash::make('7aq31rr23'),
      'uuid' => \Str::uuid(),
      'gender_id' => 1,
      'country_id' => 1,
      'visible' => 1,
    ]);

    RoleUser::create([
      'role_id' => 3,
      'user_id' => $user->id
    ]);


    // Test Bettina
    $user = User::create([
      'firstname' => 'Bettina',
      'name' => 'Puorger',
      'company' => '',
      'street' => '',
      'street_no' => '',
      'zip' => '8045',
      'city' => 'Zürich',
      'phone' => '077 777 77 88',
      'email' => 'viak-bettina@0704.ch',
      'email_verified_at' => \Carbon\Carbon::now(),
      'password' => \Hash::make('viak2022*'),
      'uuid' => \Str::uuid(),
      'gender_id' => 2,
      'country_id' => 1,
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
        'company' => $faker->company,
        'email' => $faker->unique()->email(),
        'email_verified_at' => \Carbon\Carbon::now(),
        'password' => \Hash::make('7aq31rr23'),
        'uuid' => \Str::uuid(),
        'gender_id' => rand(1,2),
        'country_id' => 1
      ]);

      RoleUser::create([
        'role_id' => 3,
        'user_id' => $user->id
      ]);

    }
  }
}
