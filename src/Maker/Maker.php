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
     * @var Client;
     */
    protected $client;

    /**
     * Maker constructor.
     */
    public function __construct()
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
     * @param string $apiKey
     * @return bool
     */
    public function trigger($event, $apiKey)
    {
        $url = sprintf('https://maker.ifttt.com/trigger/%s/with/key/%s', $event, $apiKey);
        $response = $this->client->request('PUT', $url, ['json' => ['value1' => 'hello world']]);
        return $response->getStatusCode() === 200;
    }

}
