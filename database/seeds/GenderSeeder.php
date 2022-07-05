<?php
namespace Database\Seeders;
use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
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
          'de' => 'männlich',
          'en' => 'male',
        ],
      ],
      [
        'description' => [
          'de' => 'weiblich',
          'en' => 'female',
        ],
      ],
      [
        'description' => [
          'de' => 'andere',
          'en' => 'other',
        ],
      ],
    ];
        
    foreach($data as $d)
    {
      Gender::create([
        'description' => [
          'de' => $d['description']['de'],
          'en' => $d['description']['en'],
        ],
      ]);
    }
  }
}
