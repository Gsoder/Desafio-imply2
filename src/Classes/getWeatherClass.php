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
        $curl = curl_init();

        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($cidade) . "&appid=" . $this->apiKey . "&lang=pt_br&units=metric";

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            throw new \Exception("cURL Error: $error");
        }

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpCode !== 200) {
            throw new \Exception("API Request Failed with HTTP Code $httpCode");
        }

        $data = json_decode($response, true);

        return $data;

        
    }
}