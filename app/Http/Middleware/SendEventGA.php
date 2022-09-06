<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Irazasyed\LaravelGAMP\Facades\GAMP;
use App\Service\ExchangeRate\PrivateBank;

class SendEventGA
{
    public function __construct(private PrivateBank $currencyRate)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $clientId = $_COOKIE['_ga'];
        dispatch(function () use ($clientId) {
            $rate = $this->currencyRate->getRate('USD');
            $gamp = GAMP::setClientId($clientId);
            $gamp->setEventCategory('test category')
                 ->setEventAction('rate')
                 ->setEventLabel($rate)
                 ->sendEvent();
        });

        return $next($request);
    }
}
