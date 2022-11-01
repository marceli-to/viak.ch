<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $admins = [
      [
        'firstname' => 'Marcel',
        'name'  => 'Stadelmann',
        'company' => 'marceli.to',
        'email' => 'm@marceli.to',
        'email_verified_at' => \Carbon\Carbon::now(),
        'password' => \Hash::make('7aq31rr'),
        'uuid' => \Str::uuid(),
        'gender_id' => 1,
        'country_id' => 1,
      ],
      [
        'firstname' => 'Oliver',
        'name'  => 'Schmid',
        'company' => 'VIAK GmbH',
        'email' => 'oliver.schmid@visualisierungs-akademie.ch',
        'email_verified_at' => \Carbon\Carbon::now(),
        'password' => \Hash::make('viak2022*'),
        'uuid' => \Str::uuid(),
        'gender_id' => 1,
        'country_id' => 1,
      ],
      [
        'firstname' => 'Lutz',
        'name'  => 'Kögler',
        'company' => 'Nightnurse AG',
        'email' => 'koegler@nightnurse.ch',
        'email_verified_at' => \Carbon\Carbon::now(),
        'password' => \Hash::make('viak2022*'),
        'uuid' => \Str::uuid(),
        'gender_id' => 1,
        'country_id' => 1,
      ],
      [
        'firstname' => 'Benedikt',
        'name'  => 'Flüeler',
        'company' => 'WBG AG',
        'email' => 'bf@wbg.ch',
        'email_verified_at' => \Carbon\Carbon::now(),
        'password' => \Hash::make('viak2022*'),
        'uuid' => \Str::uuid(),
        'gender_id' => 1,
        'country_id' => 1,
      ],
      [
        'firstname' => 'Bettina',
        'name'  => 'Puorger',
        'company' => 'WBG AG',
        'email' => 'bp@wbg.ch',
        'email_verified_at' => \Carbon\Carbon::now(),
        'password' => \Hash::make('viak2022*'),
        'uuid' => \Str::uuid(),
        'gender_id' => 2,
        'country_id' => 1,
      ],
    ];

    foreach($admins as $admin)
    {
      $user = User::create([
        'firstname' => $admin['firstname'],
        'name'  => $admin['name'],
        'email' => $admin['email'],
        'email_verified_at' => $admin['email_verified_at'],
        'password' => $admin['password'],
        'uuid' => $admin['uuid'],
        'gender_id' => $admin['gender_id'],
        'country_id' => $admin['country_id']
      ]);

      RoleUser::create([
        'role_id' => 1,
        'user_id' => $user->id
      ]);
    }

    RoleUser::create([
      'role_id' => 2,
      'user_id' => 1
    ]);

    RoleUser::create([
      'role_id' => 3,
      'user_id' => 1
    ]);
    
    RoleUser::create([
      'role_id' => 2,
      'user_id' => 2
    ]);
    RoleUser::create([
      'role_id' => 3,
      'user_id' => 2
    ]);

  }
}
