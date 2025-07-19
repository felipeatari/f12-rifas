<?php

namespace App\Services;

use Efi\EfiPay;
use Efi\Exception\EfiException;
use Exception;
use Illuminate\Support\Str;

class EfiPixService extends Service
{
    protected EfiPay $efiPay;

    public function __construct()
    {
        $options = [
            'clientId' => config('efi.client_id'),
            'clientSecret' => config('efi.client_secret'),
            'certificate' => config('efi.certificate_p12'),
            'pwdCertificate' => '',
            'sandbox' => config('efi.sandbox'),
            'debug' => false,
        ];

        $this->efiPay = new EfiPay($options);
    }

    public function createBilling(array $body): mixed
    {
        try {
            $txid = strtoupper(Str::random(26));

            $params = [ 'txid' => $txid ];

            $createBilling = $this->efiPay->pixCreateCharge($params, $body);

            if (!isset($createBilling['txid']) or !$createBilling['txid']) {
                throw new Exception('O "txid" ausente/vazio na resposta.', 502);
            }

            return $createBilling;
        } catch(EfiException $exception) {
            return $this->exception($exception);
        } catch(Exception $exception) {
            return $this->exception($exception);
        }
    }
}
