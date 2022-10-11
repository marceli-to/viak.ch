<?php
namespace Database\Seeders;
use App\Models\Course;
use App\Models\Location;
use App\Models\Event;
use App\Models\EventDate;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faker = \Faker\Factory::create();
    $courses = Course::get();

    $fees = [
      840,
      960,
      720,
      1120
    ];

    for($i = 0; $i < 100; $i++)
    { 
      $course = $courses->random();
      $date_event = $faker->dateTimeBetween('-24 week', '+32 week');
      $date_event_2 = (new \Carbon\Carbon($date_event))->addDays(1);
      $date_deadline = (new \Carbon\Carbon($date_event))->subDays(10);

      $event = Event::create([
        'registration_until' => $date_deadline,
        'min_participants' => mt_rand(2,8),
        'max_participants' => mt_rand(8,16),
        'online' => ($i % 5 == 0) ? 1 : 0, // every 5th is online
        'fee' => $fees[mt_rand(0,3)],
        'uuid' => \Str::uuid(),
        'publish' => 1,
        'course_id' => $course->id,
        'location_id' => ($i % 5 == 0) ? NULL : mt_rand(1,2) // every 5th is online and has no location_id
      ]);

      if ($i % 4 == 0)
      {
        for($ii = 0; $ii < 2; $ii++)
        {
          EventDate::create([
            'date' => $ii == 1 ? $date_event_2 : $date_event,
            'time_start' => '15.30',
            'time_end' =>  '21.15',
            'event_id' => $event->id
          ]);

          if ($ii == 0)
          {
            $event->date = $date_event;
            $event->save();
          }
        }
      }
      else
      {
        EventDate::create([
          'date' => $date_event,
          'time_start' => '14.00',
          'time_end' => '19.00',
          'event_id' => $event->id
        ]);
        
        $event->date = $date_event;
        $event->save();
      }

      $experts = User::experts()->get();
      $expert = $experts->random();

      if ($i % 6 == 0)
      {
        for($ii = 0; $ii < 2; $ii++)
        {
          $record = EventUser::where('event_id', $event->id)->where('user_id', $expert->id)->first();

          if ($record)
          {
            $expert = $experts->random();
            EventUser::create([
              'event_id' => $event->id,
              'user_id' => $expert->id,
            ]);
          }
          else
          {
            EventUser::create([
              'event_id' => $event->id,
              'user_id' => $expert->id,
            ]);
          }
        }
      }
      else
      {
        EventUser::create([
          'event_id' => $event->id,
          'user_id' => $expert->id,
        ]);
      }
    }
  }
}
