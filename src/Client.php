<?php

namespace Quentinix\AllMySMS;

/**
 * Class Client
 * @package Quentinix\AllMySMS
 */
class Client
{
    /**
     * Base of API Url
     */
    const DOMAIN = 'https://api.allmysms.com/http';

    /**
     * Version of API
     */
    const VERSION = '9.0';

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * Client constructor.
     * @param null|string $login
     * @param null|string $apiKey
     */
    public function __construct($login = null, $apiKey = null)
    {
        if ($login) {
            $this->setLogin($login);
        }
        if ($apiKey) {
            $this->setApiKey($apiKey);
        }
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $path
     * @return string
     */
    public function getUrl($path)
    {
        return sprintf('%s%s', $this->getBaseUrl(), $path);
    }

    /**
     * @param $path
     * @param array $params
     * @return array
     * @throws \Exception
     */
    public function request($path, array $params)
    {
        $this->checkBeforeRequest();

        $params['login'] = $this->login;
        $params['apiKey'] = $this->apiKey;

        $path = $this->getUrl($path);
        try {
            $curl = curl_init();
            curl_setopt($curl,CURLOPT_URL, $path);
            curl_setopt($curl,CURLOPT_POST, true);
            curl_setopt($curl,CURLOPT_POSTFIELDS, $params);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($curl);
            curl_close($curl);
        }
        catch (\Exception $e) {
            throw new \Exception('Service unreachable or too long to answer. Exception: ' . $e->getMessage());
        }
        return json_decode($result, true);
    }

    protected function checkBeforeRequest()
    {
        if (!$this->login) {
            throw new \LogicException('No login defined in client');
        }
        if (!$this->apiKey) {
            throw new \LogicException('No apiKey defined in client');
        }
    }

    /**
     * @return string
     */
    protected function getBaseUrl()
    {
        return sprintf('%s/%s',static::DOMAIN, static::VERSION);
    }

}