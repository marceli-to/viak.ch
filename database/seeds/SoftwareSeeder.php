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
        'description' => [
          'de' => 'Rhinoceros 7',
          'en' => 'Rhinoceros 7 (en)',
        ],
      ],
      [
        'description' => [
          'de' => 'Blender 3',
          'en' => 'Blender 3 (en)',
        ],
      ],
      [
        'description' => [
          'de' => 'SketchUp 2022',
          'en' => 'SketchUp 2022 (en)',
        ],
      ],
    ];
    
    foreach($data as $d)
    {
      Software::create([
        'description' => [
          'de' => $d['description']['de'],
          'en' => $d['description']['en'],
        ],
      ]);
    }
  }
}
