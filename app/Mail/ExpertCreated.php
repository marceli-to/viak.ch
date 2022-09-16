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
    // Create verification url
    $confirmUrl = \URL::temporarySignedRoute(
      'verification.confirm',
      \Carbon\Carbon::now()->addMinutes(4320),
      [
        'id' => $this->data->id,
        'token' => $this->data->confirm_token
      ]
    );

    return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                ->subject( __('Dein VIAK-Zugang') .' '. env('APP_NAME'))
                ->with(['data' => $this->data, 'confirmUrl' => $confirmUrl])
                ->markdown('mail.user.expert.create');
  }
}
