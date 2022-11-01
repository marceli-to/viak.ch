<?php
namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
          'de' => '3D-Software',
          'en' => '3D-Software (en)',
        ],
      ],
      [
        'description' => [
          'de' => 'Bildgestaltung & Handwerk',
          'en' => 'Bildgestaltung & Handwerk (en)',
        ],
      ],
      [
        'description' => [
          'de' => 'Management & Kommunikation',
          'en' => 'Management & Kommunikation (en)',
        ],
      ],
    ];
    
    foreach($data as $d)
    {
      Category::create([
        'uuid' => \Str::uuid(),
        'description' => [
          'de' => $d['description']['de'],
          'en' => $d['description']['en'],
        ],
      ]);
    }
  }
}