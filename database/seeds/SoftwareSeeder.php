<?php
namespace Database\Seeders;
use App\Models\Software;
use Illuminate\Database\Seeder;

class SoftwareSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    
    $data = [
      [
        'description' => 'Rhinoceros 7',
      ],
      [
        'description' => 'Blender 3',
      ],
      [
        'description' => 'SketchUp 2022',
      ],

    ];
    
    foreach($data as $d)
    {
      Software::create([
        'description' => $d['description'],
      ]);
    }
  }
}
