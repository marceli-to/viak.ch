<?php
namespace App\Exports;
use App\Models\Course;
use App\Exports\Sheets\CourseExportSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CoursesExport implements WithMultipleSheets
{
  /**
   * @return array
   */
  public function sheets(): array
  {
    $sheets = []; 

    // Create a sheet per course
    $courses = Course::with('pastEvents.bookings.user')->get();

    // filter out courses where bookings are empty
    foreach($courses as $course)
    {
      if (count($course->pastEvents) > 0)
      {
        foreach($course->pastEvents as $event)
        {
          if (count($event->bookings) > 0)
          {
            $sheets[] = new CourseExportSheet($course);
            break;
          }
        }
      }
    }
    return $sheets;
  }

}
