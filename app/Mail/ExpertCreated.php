<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpertCreated extends Mailable
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
    dd($this->data);

    return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                ->subject( __('Dein Zugang') .' '. env('APP_NAME'))
                ->with(['data' => $this->data])
                ->markdown('mail.user.expert.create');
  }
}
