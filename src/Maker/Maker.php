<?php

namespace Maker;

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
     * @var Client;
     */
    protected $client;

    /**
     * Maker constructor.
     *
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->setClient(new Client());
    }

    /**
     * @param Client $client
     * @return Maker
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @param string $event
     * @return bool
     */
    public function trigger($event, $value1 = null, $value2 = null, $value3 = null)
    {
        $url = sprintf('https://maker.ifttt.com/trigger/%s/with/key/%s', $event, $this->apiKey);
        $response = $this->client->request('PUT', $url, ['json' => [
            'value1' => $value1,
            'value2' => $value2,
            'value3' => $value3,
        ]]);
        return $response->getStatusCode() === 200;
    }

}
