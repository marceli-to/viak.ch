<?php
namespace App\Mail;
use App\Models\Event;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventMessageStudent extends Mailable
{
  use Queueable, SerializesModels;

  protected $message;

  /**
   * Create a new message instance.
   *
   * @param $data
   * @return void
   */
  public function __construct($message)
  {
    $this->message = $message;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $event   = $this->message->messageable->with('course')->find($this->message->messageable->id);
    $message = $this->message->with('user')->find($this->message->id);
    
    return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                ->subject($this->message->subject)
                ->with(
                    [
                      'message' => $message,
                      'event' => $event
                    ]
                  )
                ->markdown('mail.event.message-student');
  }
}