@include('pdf.partials.header')
<div class="page">
  <table class="page__info">
    <tr> 
      <td>{{ __('Kurs') }}</td>
      <td>Blender Einführungskurs</td>
    </tr>
    <tr> 
      <td>{{ __('Experte') }}</td>
      <td>Helge Maus</td>
    </tr>
    <tr> 
      <td>{{ __('Kurs-Nr.') }}</td>
      <td>02-280422</td>
    </tr>
  </table>
  <h1 class="page__title">{{ __('Teilnehmer:innen-Liste') }}<br>Blender Einführungskurs</h1>
  <div class="page__date">Zürich, {{date('d.m.Y', time())}}</div>
  <div class="page__content">
    <table class="content-table">
      <thead>
        <th style="width: 100mm">{{ __('Name, Ort') }}</th>
        <th>{{ __('Unterschrift') }}</th>
      </thead>
      <tbody>
        <tr>
          <td><strong>Marcel Stadelmann, Winterthur</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Benedikt Flüeler, Zürich</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Petra Mustermann, Uster</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Marcel Stadelmann, Winterthur</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Benedikt Flüeler, Zürich</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Petra Mustermann, Uster</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Marcel Stadelmann, Winterthur</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Benedikt Flüeler, Zürich</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Petra Mustermann, Uster</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Marcel Stadelmann, Winterthur</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Benedikt Flüeler, Zürich</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Petra Mustermann, Uster</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Marcel Stadelmann, Winterthur</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Benedikt Flüeler, Zürich</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Petra Mustermann, Uster</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Marcel Stadelmann, Winterthur</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Benedikt Flüeler, Zürich</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Petra Mustermann, Uster</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Marcel Stadelmann, Winterthur</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Benedikt Flüeler, Zürich</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Petra Mustermann, Uster</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Marcel Stadelmann, Winterthur</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Benedikt Flüeler, Zürich</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Petra Mustermann, Uster</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Marcel Stadelmann, Winterthur</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Benedikt Flüeler, Zürich</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Petra Mustermann, Uster</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Marcel Stadelmann, Winterthur</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Benedikt Flüeler, Zürich</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Petra Mustermann, Uster</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Marcel Stadelmann, Winterthur</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Benedikt Flüeler, Zürich</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Petra Mustermann, Uster</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Marcel Stadelmann, Winterthur</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Benedikt Flüeler, Zürich</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Petra Mustermann, Uster</strong></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@include('pdf.partials.footer')