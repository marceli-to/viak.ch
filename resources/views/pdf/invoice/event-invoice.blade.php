@include('pdf.partials.header')
<div class="page {{ $invoice->invoice_address ? 'has-invoice-address' : '' }}">
  
  <table class="page-info">
    <tr>
      <td class="page-info__left">
        @if ($invoice->invoice_address)
          <div style="margin-bottom: 1.5mm">{{ __('Rechnungsadresse') }}</div>
          {!! nl2br($invoice->invoice_address) !!}
          <br><br><br>
          <div style="margin-bottom: 1.5mm">{{__('Kursteilnehmer:in') }}</div>
        @endif
        {!! $invoice->booking->user->address !!}
        <br><br><br>
        {{ __('Buchung') }}
        {{ $invoice->booking->number }}<br>
        {{ __('Zahlbar bis') }}
        {{ $invoice->due_at_short }}<br>
      </td>
    </tr>
  </table>

  <h1 class="page__title">
    {{ __('Rechnung') }} {{ $invoice->number }}
  </h1>
  <div class="page__date">Zürich, {{ $invoice->date_short }}</div>
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
          <td style="width: 75mm"><strong>{{ $invoice->booking->event->course->title }}</strong></td>
          <td style="width: 31mm">{{ $invoice->booking->event->date_short }}</td>
          <td style="width: 31mm">{{ $invoice->booking->event->number }}</td>
          <td style="width: 22mm" class="align-right">
            <strong>CHF {{ $invoice->total }}</strong>
          </td>
        </tr>

        @if ($invoice->discount)
          <tr>
            <td colspan="3" style="width: 144mm">Abzüglich Rabatt</td>
            <td style="width: 20mm" class="align-right">
              CHF {{ $invoice->discount }}
            </td>
          </tr>
        @endif

        <tr>
          <td colspan="3" style="width: 144mm">Mehrwertsteuer (0%)</td>
          <td style="width: 20mm" class="align-right">
            CHF {{ \FormatHelper::number($invoice->vat) }}
          </td>
        </tr>

        <tr class="content-table__footer">
          <td colspan="3">
            <strong>Total</strong>
          </td>
          <td class="align-right">
            <strong>CHF {{ $invoice->grand_total }}</strong>
          </td>
        </tr>
      </tbody>
    </table>
    {{-- <p>{{ config('invoice.account_data') }}</p> --}}
  </div>
</div>
@include('pdf.invoice.partials.qr')
@include('pdf.partials.footer')