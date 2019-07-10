<?php

namespace Quentinix\AllMySMS\Service;

use Quentinix\AllMySMS\Service;

/**
 * Class Tools
 * @package Quentinix\AllMySMS\Service
 */
class Tools extends Service
{
    /**
     * Get cost for send SMS to country Number (ISO format ex: FR / DE / ...)
     * Example response:
     * {
     *      "isoCode": "FR",
     *      "nbCredits": "15"
     * }
     *
     * @param $countryIsoCode
     * @return array
     */
    public function getSMSCostForCountry($countryIsoCode)
    {
        return $this->client->request('/getCreditsByCountryIsoCode/', [
            'countryIsoCode' => $countryIsoCode
        ]);
    }
    
    /**
     * Get prices for send SMS of services
     * Example response:
     * {
     *      "countries": [{
     *          "isoCode": "FR",
     *          "sms": 0.045,
     *          "directdeposit": 0.19,
     *          "tts": 0.09,
     *          "call": 0.09,
     *          "prefix": 33
     *       }]
     *  }
     *
     * @param $countryIsoCode
     * @return array
     */
    public function getPrices($countryIsoCode = null)
    {
        $params = [];
        if (! is_null($countryIsoCode)) {
            $params = ['countryIsoCode' => $countryIsoCode];
        }
        return $this->client->request('/getPrices/', $params);
    }

    /**
     * Shorten URL
     * Example response:
     * {
     *      "url": "http:\/\/www.yoururl.fr",
     *      "shortUrl": "http:\/\/bs.ms\/xxxx"
     * }
     *
     * @param $url
     * @return array
     */
    public function shortenUrl($url)
    {
        return $this->client->request('/shortenUrl/', [
            'url' => $url,
            'returnformat' => 'json'
        ]);
    }
}
