<?php
namespace Database\Factories;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Event::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {

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

    $rand = mt_rand(0,11);

    return [
      'title' => $courses[$rand],
      'date' => $this->faker->dateTimeBetween('-2 week', '+12 week'),
      'expert' => $this->faker->name(),
    ];
  }
}
