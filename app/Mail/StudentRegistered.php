<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentRegistered extends Mailable
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
    $verifyUrl = \URL::temporarySignedRoute(
      'verification.verify',
      \Carbon\Carbon::now()->addMinutes(\Config::get('auth.verification.expire', 360)),
      [
        'id' => $this->data->id,
        'hash' => sha1($this->data->email)
      ]
    );

    return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                ->subject( __('Bestätigung Anmeldung'))
                ->with(['data' => $this->data, 'verifyUrl' => $verifyUrl])
                ->markdown('mail.user.student.register');
  }
}
