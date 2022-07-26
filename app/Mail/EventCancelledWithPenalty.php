<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Helpers\PenaltyHelper;

class EventCancelledWithPenalty extends Mailable
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
    return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                ->subject(__('Annullationsbestätigung') . ' – ' . $this->data->course->title)
                ->with([
                  'data' => $this->data,
                  'cancellation' => PenaltyHelper::get($this->data->date, $this->data->courseFee)
                ])
                ->markdown('mail.booking.cancellation-with-penalty');
  }
}