<?php

namespace Imply\DesafioImply2\Classes;

class getCoordsClass
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getCoordinates($estado, $cidade)
    {
        // Construir a URL da API com os parâmetros de consulta
        $url = "https://api.opencagedata.com/geocode/v1/json?q=" . urlencode($cidade . ', ' . $estado) . "&key=" . $this->apiKey;

        // Fazer a solicitação para a API
        $response = file_get_contents($url);

        // Decodificar a resposta JSON
        $data = json_decode($response, true);

        // Verificar se a resposta foi bem-sucedida e se há resultados
        if ($data && isset($data['results']) && !empty($data['results'])) {
            // Obter as coordenadas da primeira entrada
            $firstResult = $data['results'][0];
            $latitude = $firstResult['geometry']['lat'];
            $longitude = $firstResult['geometry']['lng'];

            // Retornar as coordenadas encontradas
            return ['latitude' => $latitude, 'longitude' => $longitude];
        } else {
            // Se não houver resultados, retornar null ou lançar uma exceção, dependendo do seu caso de uso
            return null;
        }
    }
}
