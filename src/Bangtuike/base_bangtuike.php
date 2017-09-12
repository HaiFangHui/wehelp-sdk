<?php

require_once "Config.php";
require_once "Http/Client.php";

if (!function_exists('curl_init')) {
    throw new Exception('Bangtuike needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
    throw new Exception('Bangtuike needs the JSON PHP extension.');
}

abstract class BaseBangtuike
{

    protected $headers;
    protected $domain;

    public function __construct($config)
    {
        $this->headers = $config;
    }

    protected function __get_r($url, $params, $id = 0)
    {
        $headers = $this->getHeaders();
        $url     = $this->domain . $url;
        $url     = $this->addParams($url, $params);

        $response = Client::get($url, $headers);

        if (!$response->ok()) {
            throw new Exception($response->error);
        }
        return json_decode(json_encode($response->json(), JSON_UNESCAPED_UNICODE));
    }

    protected function __post_r($url, $params, $id = 0)
    {
        $headers  = $this->getHeaders();
        $url      = $this->domain . $url;
        $response = Client::post($url, json_encode($params), $headers);
        if (!$response->ok()) {
            throw new Exception($response->error);
        }
        return json_decode(json_encode($response->json(), JSON_UNESCAPED_UNICODE));
    }

    public function getHeaders()
    {
        $source  = array('Content-type' => 'application/json;charset=UTF-8');
        $headers = $this->headers;

        if (isset($headers['env']) && $headers['env'] == Config::PRODUCT) {
            $this->domain = Config::PRODUCT_DOMAIN;
        } else {
            $this->domain = Config::TEST_DOMAIN;
        }

        if (isset($headers['env'])) {
            unset($headers['env']);
        }
        return array_merge($source, $headers);
    }

    public function addParams($url, $params)
    {
        $params_str = '';
        if ($params) {
            foreach ($params as $key => $value) {
                $params_str .= $key . '=' . $value . '&';
            }
            return $url . "?" . substr($params_str, 0, strlen($params_str) - 1);
        }
        return $url;
    }

}
