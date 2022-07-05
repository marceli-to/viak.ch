<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      \Database\Seeders\GenderSeeder::class,
      \Database\Seeders\RoleSeeder::class,
      \Database\Seeders\AdminSeeder::class,
      \Database\Seeders\ExpertSeeder::class,
      \Database\Seeders\StudentSeeder::class,
      \Database\Seeders\CategorySeeder::class,
      \Database\Seeders\SoftwareSeeder::class,
      \Database\Seeders\TagSeeder::class,
      \Database\Seeders\LocationSeeder::class,
      \Database\Seeders\CourseSeeder::class,
      \Database\Seeders\EventSeeder::class,
    ]);
  }
}
