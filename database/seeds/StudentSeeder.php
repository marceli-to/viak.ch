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
      'firstname' => 'Peter',
      'name' => 'Müller',
      'company' => 'Acme Inc',
      'street' => 'Dorfstrasse',
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
      'firstname' => 'Paul',
      'name' => 'Huber',
      'company' => '',
      'street' => 'Unter den Linen',
      'street_no' => '12',
      'zip' => '5000',
      'city' => 'Aarau',
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
      'firstname' => 'Klaus',
      'name' => 'Steiner',
      'company' => 'Steiner 3D',
      'street' => 'Bertastrasse',
      'street_no' => '4a',
      'zip' => '8000',
      'city' => 'Zürich',
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
      'firstname' => 'Petra',
      'name' => 'Dora',
      'company' => '',
      'street' => 'Schanzenstrasse',
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
      'firstname' => 'Hans',
      'name' => 'Muster',
      'company' => '',
      'street' => 'Bahnhofstrasse',
      'street_no' => '23',
      'zip' => '8004',
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

    // Test student 6
    $user = User::create([
      'firstname' => 'Gilbert',
      'name' => 'Huber',
      'company' => '',
      'street' => 'Feldstrasse',
      'street_no' => '99',
      'zip' => '4000',
      'city' => 'Basel',
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

    $user = User::create([
      'firstname' => 'Peter',
      'name' => 'Test',
      'company' => '',
      'street' => 'Teststrasse',
      'street_no' => '99',
      'zip' => '8000',
      'city' => 'Testhausen',
      'phone' => '079 999 88 77',
      'email' => 'viak-test@0704.ch',
      'email_verified_at' => \Carbon\Carbon::now(),
      'password' => \Hash::make('viak-test-0704-2024'),
      'uuid' => \Str::uuid(),
      'gender_id' => 1,
      'country_id' => 1,
      'visible' => 1,
    ]);

    RoleUser::create([
      'role_id' => 3,
      'user_id' => $user->id
    ]);

  }
}
