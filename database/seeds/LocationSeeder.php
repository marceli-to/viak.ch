<?php
namespace Database\Seeders;
use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
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
          'de' => 'VIAK Zürich',
          'en' => 'VIAK Zürich (en)',
        ],
        'address' => [
          'de' => "Förlibuckstrasse 240\n8006 Zürich",
          'en' => "Förlibuckstrasse 240\n8006 Zurich",
        ],
        'map' => 'https://goo.gl/maps/JJhSmLv5aKpPz2Pw5',
      ],
      [
        'description' => [
          'de' => 'VIAK Bern',
          'en' => 'VIAK Bern (en)',
        ],
        'address' => [
          'de' => "Bundesstrasse 4\nBern",
          'en' => "Bundesstrasse 4\n3000 Bern",
        ],
        'map' => 'https://goo.gl/maps/9JTRGV719VGY9BUA8',
      ],
    ];
    
    foreach($data as $d)
    {
      Location::create([
        'description' => [
          'de' => $d['description']['de'],
          'en' => $d['description']['en'],
        ],
        'address' => [
          'de' => $d['address']['de'],
          'en' => $d['address']['en'],
        ],
        'map' => $d['map'],
      ]);
    }
  }
}
