<?php


namespace App\Vendors;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Http
{
    /**
     * @var ?Client
     */
    protected static ?Client $client = null;

    /**
     *  get请求
     *
     * @param $url
     * @param array $params
     * @param array $header
     * @param int $timeout
     * @param bool $decode
     * @return array|string|null
     * @throws GuzzleException
     */
    public static function get($url, array $params = [], array $header = [], int $timeout = 10, bool $decode = true): array|string|null
    {
        $client = self::getClient();
        $response = $client->get($url, ['query' => $params, 'connect_timeout' => $timeout, 'headers' => $header]);
        $content = $response->getBody()->getContents();
        return $decode ? json_decode($content, true) : $content;
    }

    /**
     * @param $url
     * @param array $params
     * @param array $header
     * @param int $timeout
     * @param bool $decode
     * @return mixed|string
     * @throws GuzzleException
     */
    public static function postBody($url, array $params = [], array $header = [], int $timeout = 5, bool $decode = true): mixed
    {
        $params = is_array($params) ? \json_encode($params, JSON_UNESCAPED_UNICODE) : $params;
        $client = self::getClient();
        $response = $client->post($url, ['body' => $params, 'connect_timeout' => $timeout, 'headers' => $header]);
        $content = $response->getBody()->getContents();
        return $decode ? json_decode($content, true) : $content;
    }

    /**
     * 获取client
     *
     * @return Client|null
     */
    public static function getClient(): ?Client
    {
        if ($client = self::$client) {
            return $client;
        }
        self::$client = new Client();

        return self::$client;
    }

}

