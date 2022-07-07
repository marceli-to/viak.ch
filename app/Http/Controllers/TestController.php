<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Job;
use App\Models\Event;
use App\Models\Course;
use App\Models\User;
use App\Events\EventBooked;
use Illuminate\Http\Request;

class TestController extends BaseController
{
  protected $viewPath = 'web.pages.';

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
    // $software = \App\Models\Software::get();
    // foreach($software as $s)
    // {
    //   echo $s->description;
    //   echo '<br>';
    // }

    // echo '<br>';

    // $category = \App\Models\Category::get();
    // foreach($category as $c)
    // {
    //   echo $c->description;
    //   echo '<br>';
    // }

    // echo '<br>';

    // $tag = \App\Models\Tag::get();
    // foreach($tag as $t)
    // {
    //   echo $t->description;
    //   echo '<br>';
    // }

    // echo '<br>';

    // $user = \App\Models\User::with('gender')->get();
    // foreach($user as $u)
    // {
    //   echo "{$u->firstname} {$u->name}, {$u->email}, {$u->gender->description}";
    //   echo '<br>';
    // }
    
    // echo '<br>';
    // $genders = \App\Models\Gender::with('users')->get();
    // dd($genders);
    // $courses = Course::with('events.location')->get();
    // dd($courses[0], $courses[5]);
    
    //$user = \App\Models\User::with('gender')->get();

    // dd(\App\Models\Event::with('experts')->get());

    // $users = \App\Models\User::experts()->get();
    // $ids = $users->pluck('id');

    // dd($ids->all());
    // foreach($users as $u)
    // {
    //   echo $u->fullname;
    //   echo '<br>';
    // }

    // $courses = \App\Models\Course::with('events.location', 'events.dates', 'events.experts')->get();
    // dd($courses[10]);

    // $ids = \App\Models\EventUser::get(['user_id'])->unique('user_id')->pluck('user_id');
    // $experts = \App\Models\User::whereIn('id', $ids)->get();
    // $data = $experts->pluck('fullname', 'uuid');
    // dd($data->all());


    // $ids = \App\Models\CategoryCourse::get(['category_id'])->unique('category_id')->pluck('category_id');
    // $categories = \App\Models\Category::whereIn('id', $ids)->get();
    // $data = $categories->pluck('description', 'id');
    // dd($data->all());

    // $ids =  \App\Models\CourseSoftware::get(['software_id'])->unique('software_id')->pluck('software_id');
    // $software =  \App\Models\Software::whereIn('id', $ids)->get();
    // $data = $software->pluck('description', 'id');
    // dd($data->all());

    // $courses = \App\Models\Course::with('upcomingEvents.experts', 'categories')->get();
    // $courses = \App\Models\Course::whereHas('categories', function($q) {
    //   $q->whereIn('id', [1]);
    // })->with('upcomingEvents.experts', 'categories')->get();


    $query = \App\Models\Course::query()->with('upcomingEvents.experts', 'categories', 'softwares');
    

    // categories
    $categories = [1,2,3];
    $query->whereHas('categories', function ($query) use ($categories) {
      $query->whereIn('id', $categories);
    });

    // software
    $softwares= [1,2,3];
    $query->whereHas('softwares', function ($query) use ($softwares) {
      $query->whereIn('id', $softwares);
    });

    $expertUuid = 'eadd3a4e-92f2-4a84-ae3c-75c92eab15e1';
    $query->whereHas('upcomingEvents.experts', function ($query) use ($expertUuid) {
      $query->where('uuid', $expertUuid);
    });
    
    $courses = $query->get();

    $data = [];
    foreach($courses as $course)
    {
      if ($course->hasUpcomingEvents())
      {
        $filtered = $course->upcomingEvents->filter(function ($value, $key) use ($expertUuid) {
          return $value->experts->firstWhere('uuid', $expertUuid);
        });

        $event = collect($filtered->all())->first();
       
        $data[] = [
          'uuid' => $course->uuid,
          'slug' => $course->slug,
          'title' => $course->title,
          'date' => date('d. F Y', strtotime($event->date)),
          'categories' => collect($course->categories->pluck('description')->all())->implode(', '),
          'experts' => collect($event->experts->pluck('fullname')->all())->implode(', '),
          'fee' => $course->fee,
          'online' => $event->online ? TRUE : FALSE,
          'upcoming' => TRUE,
        ];
      }
      else
      {
        $data[] = [
          'uuid' => $course->uuid,
          'slug' => $course->slug,
          'title' => $course->title,
          'categories' => collect($course->categories->pluck('description')->all())->implode(', '),
          'upcoming' => FALSE,
        ];
      }
    }



    dd($data);

    // $expert = 'eadd3a4e-92f2-4a84-ae3c-75c92eab15e1';

    // $filtered = $data->each(function($course) use ($expert) {
    //   $course->upcomingEvents()->each(function($event) use ($expert) {
    //     $event->experts->filter(function($value, $key) use ($expert) {
    //       return $value->uuid == $expert;
    //     });
    //   });
    // });



    return $query->get();

    // if ($request->filled('category')) {
    //   $categorySlug = $request->category;
    //   $query->whereHas('category', function ($query) use ($categorySlug) {
    //       $query->where('slug', $categorySlug);
    //   });
    // }

    // if ($request->filled('brand')) {
    //   $brandSlug = $request->brand;
    //   $query->whereHas('brand', function ($query) use ($brandSlug) {
    //       $query->where('slug', $brandSlug);
    //   });
    // }



    // $courses = \App\Models\Course::whereHas('user', function($q) {
    //   $q->where('uuid', '442d63c8-27a1-4ea7-9d1f-cedf9e955e6e');
    // })->with('upcomingEvents.experts', 'categories')->get();
    // dd($courses);



 
  }

  public function courses()
  {
    $courses = Course::with('events.location', 'events.dates', 'events.experts', 'categories')->get();
    return view($this->viewPath . 'courses.index', ['courses' => $courses]);
  }

  public function course()
  {
    return view($this->viewPath . 'courses.show');
  }
}
