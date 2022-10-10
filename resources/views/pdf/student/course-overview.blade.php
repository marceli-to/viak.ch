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
  <h1 class="page__title">{{ __('Kursübersicht') }}</h1>
  <div class="page__date">Zürich, {{date('d.m.Y', time())}}</div>
  <div class="page__content">
    <table class="content-table">
      <thead>
        <th>{{ __('Titel') }}</th>
        <th>{{ __('Datum') }}</th>
        <th>{{ __('Kurs-Nummer') }}</th>
        <th>{{ __('Status') }}</th>
      </thead>
      <tbody>
        <tr>
          <td style="width: 80mm"><strong>Blender Einführungskurs</strong></td>
          <td style="width: 28mm">28.04.2022</td>
          <td style="width: 31mm">02-280422</td>
          <td style="width: 25mm">besucht</td>
        </tr>
        <tr>
          <td><strong>Visual Storytelling</strong></td>
          <td>01.06.2022</td>
          <td>03-010622</td>
          <td>besucht</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@include('pdf.partials.footer')