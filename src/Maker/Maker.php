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

    const DEFAULT_MAKER_URL = 'https://maker.ifttt.com/trigger/%s/with/key/%s';

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
        $this->apiKey = $apiKey;
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
     * @param string $value1
     * @param string $value2
     * @param string $value3
     *
     * @return bool
     */
    public function trigger($event, $value1 = null, $value2 = null, $value3 = null)
    {
        $url = sprintf(self::DEFAULT_MAKER_URL, $event, $this->apiKey);
        $response = $this->client->request('PUT', $url, ['json' => [
            'value1' => $value1,
            'value2' => $value2,
            'value3' => $value3,
        ]]);
        if ($response->getStatusCode() === 200) {
            if ($response->getBody()->getContents() === "Congratulations! You've fired the {$event} event") {
                return true;
            }
        }
        return false;
    }

}
