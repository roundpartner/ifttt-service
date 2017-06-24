<?php

namespace RoundPartner\Maker;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;

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
     * @var PromiseInterface[]
     */
    protected $promises;

    /**
     * Maker constructor.
     *
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->trigger = new Trigger($apiKey, new Client());
        $this->apiKey = $apiKey;
        $this->promises = array();
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
        $request = RequestFactory::factory($event, $value1, $value2, $value3);
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
        $request = RequestFactory::factory($event, $value1, $value2, $value3);
        try {
            $this->promises[] = $this->trigger->triggerAsync($request);
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }

    public function __destruct()
    {
        foreach ($this->promises as $promise) {
            if ($promise->getState() === PromiseInterface::PENDING) {
                $promise->wait();
            }
        }
    }
}
