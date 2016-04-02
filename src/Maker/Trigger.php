<?php

namespace RoundPartner\Maker;

use GuzzleHttp\ClientInterface;

class Trigger
{

    const DEFAULT_MAKER_URL = 'https://maker.ifttt.com/trigger/%s/with/key/%s';

    /**
     * @var string
     */
    protected $apiKey;
    
    /**
     * @var \GuzzleHttp\Client;
     */
    protected $client;

    /**
     * Trigger constructor.
     *
     * @param string apiKey
     * @param ClientInterface $client
     */
    public function __construct($apiKey, ClientInterface $client)
    {
        $this->apiKey = $apiKey;
        $this->client = $client;
    }

    /**
     * @param ClientInterface $client
     * @return Maker
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
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
