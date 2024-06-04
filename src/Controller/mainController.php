<?php

namespace Imply\DesafioImply2\Controller;

use Imply\DesafioImply2\Classes\getWeatherClass;

class mainController
{
    private $apiKey = "63ebc0939705091b3565c449a4c6f266";

    public function handleRequest()
    {

        $action = $_GET['action'] ?? '';

        switch ($action) {
            case 'getWeather':
                $this->getWeather();
                break;
            default:
                $this->sendResponse(['error' => 'Ação inválida'], 400);
                break;
        }
    }

    private function getWeather()
    {
        try {
            $cidade = $_POST['cidade'] ?? '';

            if (empty($cidade)) {
                throw new \Exception('Cidade não fornecida');
            }

            $weather = new getWeatherClass($this->apiKey);
            $data = $weather->getWeather($cidade);

            $this->sendResponse($data);
        } catch (\Exception $e) {
            $this->sendResponse(['error' => $e->getMessage()], 500);
        }
    }

    private function sendResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}