<?php
namespace App\Mail;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventCancelled extends Mailable
{
  use Queueable, SerializesModels;

  protected $data;

  /**
   * Create a new message instance.
   *
   * @param $data
   * @return void
   */
  public function __construct($data)
  {
    $this->data = $data;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $booking = Booking::withTrashed()->with('user', 'event')->find($this->data->id);
    return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                ->subject(__('Annullationsbestätigung') . ' – ' . $booking->event->course->title)
                ->with(['data' => $booking])
                ->markdown('mail.booking.cancellation');
  }
}