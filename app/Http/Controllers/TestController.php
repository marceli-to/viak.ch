<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Job;
use App\Models\Event;
use App\Models\User;
use App\Events\EventBooked;
use Illuminate\Http\Request;

class TestController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function booked()
  {
    $user = User::first();
    $event = Event::first();
    event(new EventBooked($user, $event));
  }

  public function notify()
  {
    $event = Event::first();
    $job = Job::create([
      'recipient' => 'a@hundekot.ch',
      'mailable_id' => $event->id,
      'mailable_type' => Event::class,
      'mailable_class' => \App\Mail\EventReminder::class
    ]);
  }

  public function process()
  {
    $jobs = Job::with('mailable')->unprocessed()->get();
    $jobs = collect($jobs)->splice(0,1);
    
    foreach($jobs->all() as $j)
    {
      $recipient = app()->environment(['production']) && $j->recipient ? $j->recipient : env('MAIL_TO');
      try
      {
        \Mail::to($recipient)->send(new $j->mailable_class($j->mailable));
        $j->processed = 1;
        $j->save();
      }
      catch(\Throwable $e)
      {
        \Log::error($e);
        $j->error = $e;
        $j->processed = 1;
        $j->save();
      }
    }

  }

  public function models()
  {
    $software = \App\Models\Software::get();
    foreach($software as $s)
    {
      echo $s->description;
      echo '<br>';
    }

    echo '<br>';

    $category = \App\Models\Category::get();
    foreach($category as $c)
    {
      echo $c->description;
      echo '<br>';
    }

    echo '<br>';

    $tag = \App\Models\Tag::get();
    foreach($tag as $t)
    {
      echo $t->description;
      echo '<br>';
    }

    echo '<br>';

    $user = \App\Models\User::with('gender')->get();
    foreach($user as $u)
    {
      echo "{$u->firstname} {$u->name}, {$u->email}, {$u->gender->description}";
      echo '<br>';
    }
    
    echo '<br>';

    $genders = \App\Models\Gender::with('users')->get();
    //dd($genders);
    die();
    //dd($software);
  }
}
