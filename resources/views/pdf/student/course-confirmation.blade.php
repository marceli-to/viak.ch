@include('pdf.partials.header')
<div class="page">
  <table class="page-info">
    <tr>
      <td class="page-info__left">
        <table>
          <tr> 
            <td>{{ __('Kursteilnehmer:in') }}</td>
            <td>Marcel Stadelmann</td>
          </tr>
          <tr> 
            <td>{{ __('Adresse') }}</td>
            <td>Letzigraben 149, 8047 Zürich</td>
          </tr>
          <tr> 
            <td>{{ __('E-Mail') }}</td>
            <td>m@marceli.to</td>
          </tr>
          <tr> 
            <td>{{ __('Telefon') }}</td>
            <td>078 513 35 41</td>
          </tr>
        </table>
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
          <td>{{ __('Buchungs-Nr.') }}</td>
          <td><strong>000001</strong></td>
        </tr>
      </tbody>
    </table>
    <p>{{ __('Wir bestätigen, dass Marcel Stadelmann oben aufgeführte Kurse erfolgreich absolviert hat.') }}</p>
    @include('pdf.partials.signature')
  </div>
</div>
@include('pdf.partials.footer')