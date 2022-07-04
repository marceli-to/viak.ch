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
        'description' => '3D-Software',
      ],
      [
        'description' => 'Bildgestaltung & Handwerk',
      ],
      [
        'description' => 'Management & Kommunikation',
      ],
    ];
    
    foreach($data as $d)
    {
      Category::create([
        'description' => $d['description'],
      ]);
    }
  }
}
