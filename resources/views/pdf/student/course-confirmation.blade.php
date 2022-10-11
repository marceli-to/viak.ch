@include('pdf.partials.header')
<div class="page">
  <table class="page-info">
    <tr>
      <td class="page-info__left">
        {{ __('Kursteilnehmer:in') }}<br>
        Marcel Stadelmann<br>
        Letzigraben 149<br>
        8047 Zürich
      </td>
    </tr>
  </table>
  <h1 class="page__title">{{ __('Kursbestätigung') }}<br>Marcel Stadelmann</h1>
  <div class="page__date">Zürich, {{date('d.m.Y', time())}}</div>
  <div class="page__content">
    <table class="content-table">
      <tbody>
        <tr>
          <td>{{ __('Kurs') }}</td>
          <td><strong>Blender Einführungskurs</strong></td>
        </tr>
        <tr>
          <td>{{ __('Kurs-Nr.') }}</td>
          <td><strong>02.280422</strong></td>
        </tr>
        <tr>
          <td>{{ __('Datum') }}</td>
          <td><strong>28.04.2022</strong></td>
        </tr>
        <tr>
          <td>{{ __('Experte') }}</td>
          <td><strong>Helge Maus</strong></td>
        </tr>
        <tr>
          <td>{{ __('Buchung') }}</td>
          <td><strong>000001</strong></td>
        </tr>
      </tbody>
    </table>
    <p>[Lorem ipsum dolor sit amet. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.]</p>
    <p>{{ __('Wir bestätigen, dass Marcel Stadelmann oben aufgeführte Kurse erfolgreich absolviert hat.') }}</p>
    @include('pdf.partials.signature')
  </div>
</div>
@include('pdf.partials.footer')