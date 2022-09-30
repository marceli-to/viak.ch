<?php
namespace App\Mail;
use App\Models\Message as MessageModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Message extends Mailable
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
    // $message = Message::with('course')->find($this->data->id);
    //dd($this->data);

    $message = $this->data;

    dd($message);

    // return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
    //             ->subject(__('Buchungsbestätigung') . ' – ' . $booking->event->course->title)
    //             ->with(['data' => $booking])
    //             ->markdown('mail.event.message');
  }
}