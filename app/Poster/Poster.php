<?php

namespace App\Poster;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class Poster
{
    private $client;
    private $body;
    private $headers;
    private $routes;
    private $token;

    private $url;
    private $method;

    public function __construct(array $config)
    {
        $this->client = new Client([
            'base_uri' => $config['base_url']
        ]);
        $this->routes = $config['routes'];
        $this->token = $config['token'];
    }

    public function setBody(array $body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getDefaultHeaders()
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];
    }

    public function setOnUrl($key, $value)
    {
        if ($key) {
            $url = $this->getUrl();
            $url .= "&$value=" . $key;
            $this->setUrl($url);
        }
    }

    public function request()
    {
        $headers = $this->getHeaders();
        $headers = !empty($headers) ? array_merge($headers, $this->getDefaultHeaders()) : $this->getDefaultHeaders();

        $options = array_merge(
            ['body' => json_encode($this->getBody())],
            ['headers' => $headers]
        );

        try {
            return $this->client->request($this->method, $this->url, $options);
        } catch (GuzzleException $e) {
            throw $e;
        }
    }

    public function setRoute(array $keys)
    {
        $this->url = $this->setHost($keys, 'url');
        $this->setToken();

        $this->method = $this->setHost($keys, 'method');
    }

    private function setHost(array $keys, string $value): string
    {
        $route = $this->routes;
        foreach ($keys as $k) {
            $route = !empty($route[$k]) ? $route[$k] : null;
        }

        $route = !empty($route[$value]) ? $route[$value] : null;


        if (empty($route)) {
            throw new NotFoundResourceException('Route not found in poster.php file');
        }

        return $route;
    }

    private function setToken()
    {
        $this->url .= '?token=' . $this->token;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }
}
