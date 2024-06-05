<?php
namespace Imply\DesafioImply2\Classes;

class getWeatherClass
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getWeather($cidade)
    {
        $url = "http://api.openweathermap.org/data/2.5/weather?q=" . urlencode($cidade) . "&appid=" . $this->apiKey . "&units=metric";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = 'cURL Error: ' . curl_error($ch);
            curl_close($ch);
            throw new \Exception($error_msg);
        }

        curl_close($ch);

        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('JSON decode error: ' . json_last_error_msg());
        }

        if (isset($data['cod']) && $data['cod'] != 200) {
            throw new \Exception('API error: ' . $data['message']);
        }

        return $data;
    }
}