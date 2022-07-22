@include('pdf.partials.header')
<div class="page">
  <table class="page__info">
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
    <tr> 
      <td>{{ __('Buchungs-Nr.') }}</td>
      <td>0000001</td>
    </tr>
  </table>
  <h1 class="page__title">
    {{ __('Rechnung Nr.') }}<br>
    {{ $data['invoice_number'] }}
  </h1>
  <div class="page__date">Zürich, {{date('d.m.Y', time())}}</div>
  <div class="page__content">
    <table class="content-table" style="margin-bottom: 5mm">
      <thead>
        <th>{{ __('Kurs') }}</th>
        <th>{{ __('Datum') }}</th>
        <th>{{ __('Kurs-Nummer') }}</th>
        <th class="align-right">{{ __('Preis') }}</th>
      </thead>
      <tbody>
        <tr>
          <td style="width: 85mm"><strong>Blender Einführungskurs</strong></td>
          <td style="width: 28mm">28.04.2022</td>
          <td style="width: 31mm">02-280422</td>
          <td style="width: 20mm" class="align-right">
            <strong>CHF 899.00</strong>
          </td>
        </tr>
        <tr class="content-table__footer">
          <td colspan="3">
            <strong>Total</strong>
          </td>
          <td class="align-right">
            <strong>CHF&nbsp;&nbsp;899.00</strong>
          </td>
        </tr>
      </tbody>
    </table>
    <p>Postkonto 87-676317-9, IBAN CH80 0900 0000 8767 6317 9, BIC POFICHBEXXX</p>
  </div>
</div>
@include('pdf.invoice.partials.qr')
@include('pdf.partials.footer')