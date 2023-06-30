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
    $course = Course::with('pastEvents.bookings.user.gender')->find($this->course->id);

    $data = [];

    foreach($course->pastEvents as $event)
    {
      foreach($event->bookings as $booking)
      {
        $data[] = [
          'gender' => $booking->user->gender->description,
          'firstname' => $booking->user->firstname,
          'name' => $booking->user->name,
          'company' => $booking->user->company,
          'street' => $booking->user->street,
          'street_no' => $booking->user->street_no,
          'zip' => $booking->user->zip,
          'city' => $booking->user->city,
          'phone' => $booking->user->phone,
          'email' => $booking->user->email,
          'date' => $booking->event->date_short
        ];
      }
    }    
    return collect($data);
  }

  public function headings(): array
  {
    return [
      'Anrede',
      'Vorname',
      'Nachname',
      'Firmenname',
      'Strasse',
      'Hausnummer',
      'PLZ',
      'Ort',
      'Tel',
      'E-Mail',
      'Kursdatum'
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