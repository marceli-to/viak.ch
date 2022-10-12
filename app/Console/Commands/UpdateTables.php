<?php
namespace App\Console\Commands;
use App\Models\Tag;
use App\Models\Level;
use App\Models\Language;
use App\Models\Software;
use App\Models\Category;
use Illuminate\Console\Command;

class UpdateTables extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'update:tables';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Update a bunch of database tables';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $data = Tag::get();
    foreach($data as $d)
    {
      $d->uuid = \Str::uuid();
      $d->save();
    }

    $data = Level::get();
    foreach($data as $d)
    {
      $d->uuid = \Str::uuid();
      $d->save();
    }

    $data = Software::get();
    foreach($data as $d)
    {
      $d->uuid = \Str::uuid();
      $d->save();
    }

    $data = Language::get();
    foreach($data as $d)
    {
      $d->uuid = \Str::uuid();
      $d->save();
    }

    $data = Category::get();
    foreach($data as $d)
    {
      $d->uuid = \Str::uuid();
      $d->save();
    }
  }
}
