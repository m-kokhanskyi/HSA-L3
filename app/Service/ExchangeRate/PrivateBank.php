<?php

namespace App\Service\ExchangeRate;


use Exception;
use Illuminate\Support\Facades\Http;

class PrivateBank
{
    /**
     * @throws Exception
     */
    public function getRate(string $currency): float
    {
        $result = null;
        $rates = Http::get('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json')->collect();
        foreach ($rates as $rate) {
            if ($rate['cc'] === $currency) {
                $result = $rate['rate'];
            }
        }

        if ($result === null) {
            throw new Exception('Not found currency');
        }
        return $result;
    }
}
