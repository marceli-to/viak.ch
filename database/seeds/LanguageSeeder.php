<?php
namespace Database\Seeders;
use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
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
          'de' => 'deutsch',
          'en' => 'german',
        ],
      ],
      [
        'description' => [
          'de' => 'englisch',
          'en' => 'english',
        ],
      ],
    ];
    
    foreach($data as $d)
    {
      Language::create([
        'description' => [
          'de' => $d['description']['de'],
          'en' => $d['description']['en'],
        ],
      ]);
    }
  }
}