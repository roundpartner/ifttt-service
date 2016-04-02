<?php

namespace RoundPartner\Maker;

use GuzzleHttp\Client;

/**
 * Class Maker
 *
 * @package Maker
 */
class Maker
{

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var Trigger;
     */
    protected $trigger;

    /**
     * Maker constructor.
     *
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->trigger = new Trigger($apiKey, new Client());
        $this->apiKey = $apiKey;
    }

    /**
     * @param \GuzzleHttp\ClientInterface $client
     * @return Maker
     */
    public function setClient($client)
    {
        $this->trigger->setClient($client);
        return $this;
    }

    /**
     * @param string $event
     * @param string $value1
     * @param string $value2
     * @param string $value3
     *
     * @return bool
     */
    public function trigger($event, $value1 = null, $value2 = null, $value3 = null)
    {
        return $this->trigger->trigger($event, $value1, $value2, $value3);
    }
}
