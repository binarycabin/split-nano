<?php

namespace App\Services\Nano;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class Nano
{

    private $client;
    private $host;

    public function __construct()
    {
        $this->client = new Client();
        $this->setHost(config('split.nano.node_uri'));
    }

    public function setHost($host)
    {
        $this->host = $host;
    }

    private function getClient()
    {
        return $this->client;
    }

    private function getHost()
    {
        return $this->host;
    }

    public function call($action, $options = [])
    {
        $options['action'] = $action;
        $response = $this->getClient()->post($this->getHost(),
            [
                RequestOptions::JSON => $options
            ]
        );
        return json_decode($response->getBody()->getContents());
    }

    public function generateSeed()
    {
        return strtoupper(bin2hex(openssl_random_pseudo_bytes(32)));
    }

}