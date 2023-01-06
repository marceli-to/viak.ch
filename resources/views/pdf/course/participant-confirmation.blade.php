@include('pdf.partials.header')
<div class="page">
  <table class="page-info">
    <tr>
      <td class="page-info__left">
        {{ __('Kursteilnehmer:in') }}<br>
        {!! $booking->user->address !!}
      </td>
    </tr>
  </table>
  <h1 class="page__title">{{ __('Teilnahmebestätigung') }}<br>{{ $booking->user->fullname }}</h1>
  <div class="page__date">Zürich, {{ date('d.m.Y', strtotime($booking->event->closed_at)) }}</div>
  <div class="page__content">
    <table class="content-table">
      <tbody>
        <tr>
          <td>{{ __('Kurs') }}</td>
          <td><strong>{{ $booking->event->course->title }}</strong></td>
        </tr>
        <tr>
          <td>{{ __('Datum') }}</td>
          <td>
            <strong>
              {{ collect($booking->event->dates->pluck('date_short')->all())->implode(', ') }}
            </strong>
          </td>
        </tr>
        <tr>
          <td>{{ __('Experte') }}</td>
          <td>
            <strong>{{ $booking->event->experts_fullname_string }}</strong>
          </td>
        </tr>
        <tr>
          <td>{{ __('Buchung') }}</td>
          <td><strong>{{ $booking->number }}</strong></td>
        </tr>
      </tbody>
    </table>
    <p>{{ __('Wir bestätigen, dass Marcel Stadelmann oben aufgeführte Kurse erfolgreich absolviert hat.') }}</p>
    @if ($booking->event->course->summary)
      <div style="margin-bottom: 1mm"><strong>Kursinhalt / Beschreibung / Einleitung</strong></div>
      {!! $booking->event->course->summary !!}
      <br>
    @endif
    @include('pdf.partials.signature')
  </div>
</div>
@include('pdf.partials.footer')