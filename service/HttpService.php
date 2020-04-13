<?php
/**
 * HttpService.php
 * author lwz
 * time 2020/1/29
 */

namespace Service;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class HttpService
{

    public $client = null;

    public $uri = null;

    private $header = [];

    public $response = [];

    public function __construct($headers = [])
    {
        if (empty($headers)) {
            $this->header = $this->getHeaders();
        } else {
            $this->header = $headers;
        }
        $this->client = new Client();
    }

    private function getRequest($method, $uri, $body = [])
    {
        $this->uri = $uri;
        $body = \json_encode($body);
        return new Request($method, $uri, $this->header, $body);
    }

    public function post($url, $data = [], $callback = null)
    {
        $request = $this->getRequest('POST', $url, $data);
        $this->response = $this->client->send($request);
        if (!empty($callback) && is_array($callback) && is_object($callback[0])) {
            call_user_func_array($callback[0],
                [
                    'response' => $this->response,
                    'header' => $this->header,
                ]);
        }
        return $this->response;
    }

    public function get($url)
    {

    }

    private function getHeaderOption()
    {
        return [
            'headers' => $this->header,
        ];
    }

    private function getHeaders()
    {
        return [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Referer' => 'https://music.163.com/',
            'Origin' => 'https://music.163.com/'
        ];
    }
}
