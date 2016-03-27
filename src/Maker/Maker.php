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
        $json = $this->buildValuesArray($value1, $value2, $value3);
        $options = ['json' => $json];
        return $this->request($event, $options);
    }

    /**
     * @param string $event
     * @param array $options
     *
     * @return bool
     */
    private function request($event, $options)
    {
        $response = $this->client->request('PUT', $this->buildUrl($event), $options);
        if ($response->getStatusCode() === 200) {
            if ($response->getBody()->getContents() === "Congratulations! You've fired the {$event} event") {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $event
     *
     * @return string
     */
    private function buildUrl($event)
    {
        return sprintf(self::DEFAULT_MAKER_URL, $event, $this->apiKey);
    }

    /**
     * @param string $value1
     * @param string $value2
     * @param string $value3
     *
     * @return array
     */
    private function buildValuesArray($value1 = null, $value2 = null, $value3 = null)
    {
        $values = [
            'value1' => $value1,
            'value2' => $value2,
            'value3' => $value3,
        ];
        return array_filter($values);
    }
}
