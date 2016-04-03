<?php

namespace RoundPartner\Maker;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\PromiseInterface;
use RoundPartner\Maker\Entity\Request;

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
     *
     * @return Maker
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }
    
    /**
     * @param Request $request
     *
     * @return bool
     */
    public function trigger(Request $request)
    {
        $json = $this->buildValuesArray($request);
        $options = ['json' => $json];
        return $this->request($request, $options);
    }

    /**
     * @param Request $request
     *
     * @return PromiseInterface
     */
    public function triggerAsync(Request $request)
    {
        $json = $this->buildValuesArray($request);
        $options = ['json' => $json];
        return $this->requestAsync($request, $options);
    }
    
    /**
     * @param Request $request
     * @param array $options
     *
     * @return bool
     */
    private function request(Request $request, $options)
    {
        $response = $this->client->request('PUT', $this->buildUrl($request->event), $options);
        if ($response->getStatusCode() === 200) {
            if ($response->getBody()->getContents() === "Congratulations! You've fired the {$request->event} event") {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Request $request
     * @param array $options
     *
     * @return PromiseInterface
     */
    private function requestAsync(Request $request, $options)
    {
        return $this->client->requestAsync('PUT', $this->buildUrl($request->event), $options);
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
     * @param Request $request
     *
     * @return array
     */
    private function buildValuesArray(Request $request)
    {
        $values = [
            'value1' => $request->value1,
            'value2' => $request->value2,
            'value3' => $request->value3,
        ];
        return array_filter($values);
    }
}
