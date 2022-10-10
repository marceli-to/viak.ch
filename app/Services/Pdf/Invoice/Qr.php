<?php
namespace App\Services\Pdf\Invoice;
use App\Models\Invoice;
use Sprain\SwissQrBill as QrBill;

class Qr
{
  protected $invoice;

  public function __construct(Invoice $invoice, $clientNumber = 0)
  {
    $this->invoice = $invoice;
    $this->clientNumber = $clientNumber;
  }

  public function get()
  {
    return [
      'reference_number' => $this->getReferenceNumberString(),
      'qr_code' => $this->getQrCode(),
    ];
  }

  /**
   * Get reference number as padded string
   * 
   * @return String $referenceNumber
   */
  private function getReferenceNumberString()
  {
    $esr_customer_id = config('sipt.esr_customer_id');
    $str = $esr_customer_id . ' 00000 ' . $this->getClientNumberString() . ' ' . $this->getInvoiceNumberString();
    $str = $str . $this->getModulo10(str_replace(' ', '', $str));
    return $str;
  }

  /**
   * Get QR code
   */
  private function getQrCode()
  {
    // Create a new instance of QrBill, containing default headers with fixed values
    $qrBill = QrBill\QrBill::create();

    // Add creditor information
    // Who will receive the payment and to which bank account?
    $qrBill->setCreditor(
      QrBill\DataGroup\Element\CombinedAddress::create(
        config('invoice.beneficiary_name'),
        config('invoice.beneficiary_street'),
        config('invoice.beneficiary_city'),
        config('invoice.beneficiary_country'),
      )
    );

    $qrBill->setCreditorInformation(
      QrBill\DataGroup\Element\CreditorInformation::create(
        str_replace(' ', '', config('invoice.qr_iban'))
      )
    );

    // Add payment invoice->grand_total information
    // The currency must be defined.
    $qrBill->setPaymentAmountInformation(
      QrBill\DataGroup\Element\PaymentAmountInformation::create(
        config('invoice.currency'),
        $this->invoice->grand_total
      )
    );

    // Add payment reference
    // This is what you will need to identify incoming payments.
    $referenceNumber = QrBill\Reference\QrPaymentReferenceGenerator::generate(
      NULL,  // You receive this number from your bank (BESR-ID). Unless your bank is PostFinance, in that case use NULL.
      $this->invoice->number // A number to match the payment with your internal data, e.g. an invoice number
    );

    $qrBill->setPaymentReference(
      QrBill\DataGroup\Element\PaymentReference::create(
          QrBill\DataGroup\Element\PaymentReference::TYPE_QR,
          $referenceNumber
      ));

    // Optionally, add some human-readable information about what the bill is for.
    $qrBill->setAdditionalInformation(
      QrBill\DataGroup\Element\AdditionalInformation::create(
        'Rechnung ' . $this->invoice->number
      )
    );
    
    // Return Data URI
    return $qrBill->getQrCode()->writeDataUri();
  }


  /**
   * Get invoice number as padded string
   * 
   * @return String $invoice->number
   */

  private function getInvoiceNumberString()
  {
    $str = '';
    switch(strlen($this->invoice->number))
    {
      case 5:
        $str = str_pad(substr($this->invoice->number, 0, 1),  5, "0", STR_PAD_LEFT) . ' ' . substr($this->invoice->number, 1, strlen($this->invoice->number));
      break;

      case 6:
        $str = str_pad(substr($this->invoice->number, 0, 2),  5, "0", STR_PAD_LEFT) . ' ' . substr($this->invoice->number, 2, strlen($this->invoice->number));
      break;

      case 7:
        $str = str_pad(substr($this->invoice->number, 0, 3),  5, "0", STR_PAD_LEFT) . ' ' . substr($this->invoice->number, 3, strlen($this->invoice->number));
      break;
    }

    return $str;
  }

  /**
   * Get client number as padded string
   * 
   * @return String $clientNumber
   */

  private function getClientNumberString()
  {
    return str_pad($this->clientNumber,  5, "0", STR_PAD_LEFT);
  }

  /**
   * Calculate modulo10
   * 
   * @param integer $number
   * @return integer
   */

  private function getModulo10($number)
  {
    $table = array(0,9,4,6,8,2,7,1,3,5);
    $next = 0;
    for ($i=0; $i<strlen($number); $i++)
    {
      $next = $table[($next + substr($number, $i, 1)) % 10];
    }
    return (10 - $next) % 10;
  }
}