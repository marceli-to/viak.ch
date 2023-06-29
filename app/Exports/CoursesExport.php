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

    // Summary sheet
    // $sheets[] = new VotesSummarySheet();

    // Create a sheet per course
    $courses = Course::with('pastEvents.bookings.user')->get();
    foreach($courses as $course)
    {
      $sheets[] = new CourseExportSheet($course);
    }
    return $sheets;
  }

}
