<?php

namespace Imply\DesafioImply2\Classes;

class getWeatherClass
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getCoordinates($estado, $cidade)
    {
        $curl = curl_init();

        $url = "https://api.opencagedata.com/geocode/v1/json?q=" . urlencode($cidade . ', ' . $estado) . "&key=" . $this->apiKey;

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true, // Seguir redirecionamentos, se houver
            CURLOPT_SSL_VERIFYPEER => false, // Desabilitar a verificação do certificado SSL
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

        if ($data && isset($data['results']) && !empty($data['results'])) {
            $firstResult = $data['results'][0];
            $latitude = $firstResult['geometry']['lat'];
            $longitude = $firstResult['geometry']['lng'];

            return ['latitude' => $latitude, 'longitude' => $longitude];
        } else {
            return null;
        }
    }
}
