<?php
namespace App\Exports\Sheets;
use App\Models\Course;
use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CourseExportSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize, WithStyles
{
  private $course;

  public function __construct(Course $course)
  {
    $this->course = $course;
  }

  /**
   * @return \Illuminate\Support\Collection
   */
  public function collection()
  {
    $course = Course::with('pastEvents.bookings.user')->find($this->course->id);
    dd($course);
    // $data = [];
    // foreach($votes as $v)
    // {
    //   $data[] = [
    //     'Datum' => $v->dateExport,
    //     'IP Adresse' => $v->voter->ip_address,
    //     'Hash' => $v->voter->hash
    //   ];
    // }
    return collect($data);
  }

  public function headings(): array
  {
    return [
      'Datum',
      'IP Adresse',
      'Hash'
    ];
  }

  public function title(): string
  {
    return $this->course->title;
  }

  public function styles(Worksheet $sheet)
  {
    return [
      1 => ['font' => ['bold' => true]],
    ];
  }

}