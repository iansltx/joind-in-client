<?php

namespace iansltx\JoindInClient;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;

class Client
{
    const DEFAULT_CONFIG = ['base_uri' => 'https://api.joind.in/v2.1/'];

    public static function create()
    {
        return new static(new \GuzzleHttp\Client(static::DEFAULT_CONFIG));
    }

    protected $http;

    public function __construct(ClientInterface $httpClient)
    {
        $this->http = $httpClient;
    }

    public function getScheduleByEventId(int $id) : Schedule
    {
        try {
            return Schedule::fromParsedJson($this->getJsonArray('events/' . $id . '/talks?resultsperpage=999'));
        } catch (ClientException $e) {
            throw $e->getCode() === 404 ? new \InvalidArgumentException("Event not found", 404, $e) : $e;
        }
    }

    protected function getJsonArray($path) : array
    {
        return json_decode(
            $this->http->send(new Request('GET', $path))->getBody()->getContents(), JSON_OBJECT_AS_ARRAY);
    }
}
