<?php
namespace Database\Seeders;
use App\Models\Course;
use App\Models\Event;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faker = \Faker\Factory::create();

    $courses = [
      'Storytelling – Workshop',
      'Blender Einführungskurs',
      'Blender Renderingkurs',
      'Blender Animationskurs',
      'Visual Facilitator Basics',
      'Visual Facilitator Advanced',
      'Rhino Einstiegskurs',
      'ZBrush Einführungskurs',
      'Social Media Marketing',
      'After Effects (AE) Einstiegskurs',
      'Rhino Grasshopper Kurs für Einsteiger',
      'Geheimnisse der Architekturvisualisierung',
    ];

    $fees = [
      840,
      960,
      720,
      1120
    ];

    for($i = 0; $i<=11; $i++)
    {
      $rand2 = mt_rand(0,3);
      $course = Course::create([
        'title' => [
          'de' => $courses[$i],
          'en' => $courses[$i],
        ],
        'subtitle' => [
          'de' => $faker->sentence(6, true),
          'en' => $faker->sentence(6, true),
        ],
        'text' => [
          'de' => $faker->text(400),
          'en' => $faker->text(400),
        ],
        'fee' => $fees[$rand2],
        'uuid' => \Str::uuid(),
        'publish' => 1,
      ]);
    }
  }
}
