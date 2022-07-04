<?php
namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    
    $roles = [
      [
        'name' => 'Admin',
        'key'  => 'admin',
        'uuid' => \Str::uuid(),
      ],
      [
        'name' => 'Experte',
        'key'  => 'expert',
        'uuid' => \Str::uuid(),
      ],
      [
        'name' => 'Student',
        'key'  => 'student',
        'uuid' => \Str::uuid(),
      ]
    ];
    
    foreach($roles as $role)
    {
      Role::create([
        'name' => $role['name'],
        'key'  => $role['key'],
        'uuid' => $role['uuid'],
      ]);
    }
  }
}
