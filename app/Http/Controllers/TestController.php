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

  /**
   * Test method
   *
   * @param  Request $request
   * @return \Illuminate\Http\Response
   */

  public function test()
  {
    //dd('test');
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
}
