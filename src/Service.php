<?php

namespace Quentinix\AllMySMS;

/**
 * Class Service
 * @package Quentinix\AllMySMS
 */
abstract class Service
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Service constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


}