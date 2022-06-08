<?php

return [

  /*
  |--------------------------------------------------------------------------
  | Company name
  |--------------------------------------------------------------------------
  |
  */

  'company' => env('VIAK_COMPANY_NAME', 'Visualisierungs-Akademie Schweiz GmbH'),

  /*
  |--------------------------------------------------------------------------
  | E-Mail settings
  |--------------------------------------------------------------------------
  |
  */

  'email' => [
    'from' => env('VIAK_MAIL_FROM', 'marcel@jamon.digital'),
    'recipient' => env('VIAK_MAIL_RECIPIENT', 'm@marceli.to'),
    'bcc' => env('VIAK_MAIL_BCC', 'm@marceli.to'),
    'recipient_test' => env('VIAK_MAIL_RECIPIENT_TEST', 'm@marceli.to')
  ],

  /*
  |--------------------------------------------------------------------------
  | Domain
  |--------------------------------------------------------------------------
  |
  */

  'domain' => env('VIAK_DOMAIN', 'https://visualisierungs-akademie.ch'),

  /*
  |--------------------------------------------------------------------------
  | Chunk size for cron jobs
  |--------------------------------------------------------------------------
  |
  */

  'cron_chunk_size' => 3,
]
?>