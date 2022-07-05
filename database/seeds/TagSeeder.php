<?php
namespace Database\Seeders;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
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
          'de' => 'Modelling',
          'en' => 'Modelling (en)',
        ],
      ],
      [
        'description' => [
          'de' => 'Rendering',
          'en' => 'Rendering (en)',
        ],
      ],
      [
        'description' => [
          'de' => 'Visualisierung',
          'en' => 'Visualisierung (en)',
        ],
      ],
      [
        'description' => [
          'de' => 'Animation',
          'en' => 'Animation (en)',
        ],
      ],
      [
        'description' => [
          'de' => 'Konstruktion',
          'en' => 'Konstruktion (en)',
        ],
      ],
      [
        'description' => [
          'de' => 'Motion Graphics',
          'en' => 'Motion Graphics (en)',
        ],
      ],
      [
        'description' => [
          'de' => 'Architektur',
          'en' => 'Architektur (en)',
        ],
      ],
      [
        'description' => [
          'de' => '3D-Druck',
          'en' => '3D-Druck (en)',
        ],
      ],
    ];
    
    foreach($data as $d)
    {
      Tag::create([
        'description' => [
          'de' => $d['description']['de'],
          'en' => $d['description']['en'],
        ],
      ]);
    }
  }
}