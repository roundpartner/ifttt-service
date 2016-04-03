<?php

namespace RoundPartner\Maker;

use GuzzleHttp\Client;
use RoundPartner\Maker\Entity\Request;

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
     *
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
        $request = new Request();
        $request->event = $event;
        $request->value1 = $value1;
        $request->value2 = $value2;
        $request->value3 = $value3;
        return $this->trigger->trigger($request);
    }

    /**
     * @param string $event
     * @param string $value1
     * @param string $value2
     * @param string $value3
     *
     * @return bool
     */
    public function triggerAsync($event, $value1 = null, $value2 = null, $value3 = null)
    {
        $request = new Request();
        $request->event = $event;
        $request->value1 = $value1;
        $request->value2 = $value2;
        $request->value3 = $value3;
        try {
            $this->trigger->triggerAsync($request);
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }
}
