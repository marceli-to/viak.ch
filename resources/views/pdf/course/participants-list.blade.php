@include('pdf.partials.header')
<div class="page">
  <table class="page-info">
    <tr>
      <td class="page-info__left">
        <table>
          <tr> 
            <td>{{ __('Kurs') }}</td>
            <td>{{ $data['event']->course->title }}</td>
          </tr>
          <tr> 
            <td>{{ __('Experte') }}</td>
            <td>{{ collect($data['event']->experts->pluck('fullname')->all())->implode(', ') }}</td>
          </tr>
          <tr> 
            <td>{{ __('Kurs-Nr.') }}</td>
            <td>{{ $data['event']->number }}</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <h1 class="page__title">{{ __('Teilnehmer:innen-Liste') }}<br>{{ $data['event']->course->title }}</h1>
  <div class="page__date">Zürich, {{date('d.m.Y', time())}}</div>
  <div class="page__content">
    <table class="content-table">
      <thead>
        <th style="width: 100mm">{{ __('Teilnehmer') }}</th>
      </thead>
      <tbody>
        @foreach($data['bookings'] as $booking)
          <tr>
            <td>
              <strong>
                {{ $booking->user->fullname }}, {{ $booking->user->city }}
              </strong>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@include('pdf.partials.footer')