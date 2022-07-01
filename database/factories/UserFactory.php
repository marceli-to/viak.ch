<?php
namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = User::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'firstname' => $this->faker->firstName,
      'name' => $this->faker->lastName,
      'email' => $this->faker->unique()->email(),
      'email_verified_at' => \Carbon\Carbon::now(),
      'password' => \Hash::make('8aq31rr23'),
      'uuid' => \Str::uuid(),
    ];
  }
}
