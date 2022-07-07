<?php
namespace Database\Seeders;
use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
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
          'de' => 'Einsteiger',
          'en' => 'beginner',
        ],
      ],
      [
        'description' => [
          'de' => 'Vertiefung',
          'en' => 'in depth',
        ],
      ],
    ];
    
    foreach($data as $d)
    {
      Level::create([
        'description' => [
          'de' => $d['description']['de'],
          'en' => $d['description']['en'],
        ],
      ]);
    }
  }
}