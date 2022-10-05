<?php
namespace Database\Seeders;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
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
        'name' => [
          'de' => 'Schweiz',
          'en' => 'Switzerland',
        ],
      ],
      [
        'name' => [
          'de' => 'Deutschland',
          'en' => 'Germany',
        ],
      ],
    ];
    
    foreach($data as $d)
    {
      Country::create([
        'name' => [
          'de' => $d['name']['de'],
          'en' => $d['name']['en'],
        ],
      ]);
    }
  }
}
