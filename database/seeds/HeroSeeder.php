<?php
namespace Database\Seeders;
use App\Models\Hero;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Hero::create([
      'title'  => 'Startseite',
      'slug'  => 'home',
      'uuid' => \Str::uuid(),
    ]);
  }
}
