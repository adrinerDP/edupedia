<?php


namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class ParseNEIS
{
    const NEIS_URL = "https://stu.%s.go.kr/";
    private $client, $jar;

    public function __construct()
    {
        $this->jar = new CookieJar();
        $this->client = new Client([
            'cookie' => true,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (MSIE 10.0; Windows NT 6.1; Trident/5.0)'
            ]
        ]);

    }

    public function request($region, $uri, $json)
    {
        $this->initializeCookies($region);

        $response = $this->client->request('POST', $this->getLocalizedURL($region, $uri), [
            'cookies' => $this->jar,
            'json' => $json
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function getCourse($code)
    {
        switch($code) {
            case '초등학교':
                return '02';
                break;
            case '중학교':
                return '03';
                break;
            case '고등학교':
                return '04';
                break;
            default:
                return null;
        }
    }

    private function initializeCookies($region)
    {
        $this->client->request('GET', $this->getLocalizedURL($region, 'edusys.jsp?page=sts_m40000'), [
            'cookies' => $this->jar
        ]);
    }

    private function getLocalizedURL($region, $uri)
    {
        return sprintf(self::NEIS_URL, $region).$uri;
    }
}
