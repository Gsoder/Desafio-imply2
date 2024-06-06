<?php

namespace Imply\DesafioImply2\Controller;

use Imply\DesafioImply2\Classes\getWeatherClass;
use Imply\DesafioImply2\Classes\dbClass;

class mainController
{
    private $apiKey = "63ebc0939705091b3565c449a4c6f266";

    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    }

    private function getWeather()
{
    try {
        $cidade = $_POST['cidade'] ?: '';
        $email = $_POST['email'] ?: null;

        if (empty($cidade)) {
            throw new \Exception('Cidade não fornecida');
        }

        $conexao = new dbClass();
        $pdo = $conexao->conectar();
        $stmt = $pdo->prepare("SELECT c.Temperatura, c.Umidade, c.Vento, c.Sensacao, c.Descricao, c.Min, c.Max, c.Icon
                               FROM Historico h
                               INNER JOIN Clima c ON h.ClimaID = c.ID
                               WHERE h.Cidade = :cidade AND h.DataHora >= DATE_SUB(NOW(), INTERVAL 1 HOUR)");
        $stmt->bindParam(':cidade', $cidade);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            $data = [
                'main' => [
                    'temp' => $result['Temperatura'],
                    'humidity' => $result['Umidade'],
                    'feels_like' => $result['Sensacao'],
                    'temp_min' => $result['Min'],
                    'temp_max' => $result['Max']
                ],
                'wind' => [
                    'speed' => $result['Vento']
                ],
                'weather' => [
                    [
                        'description' => $result['Descricao'],
                        "icon" => $result['Icon']
                    ]
                ]
            ];
        } else {
            $weather = new getWeatherClass($this->apiKey);
            $data = $weather->getWeather($cidade);

            $stmt = $pdo->prepare("INSERT INTO Clima (Temperatura, Umidade, Vento, Sensacao, Descricao, Min, Max, Icon) VALUES (:temperatura, :umidade, :vento, :sensacao, :descricao, :min, :max, :icon);");
            $stmt->bindParam(':temperatura', $data['main']['temp']);
            $stmt->bindParam(':umidade', $data['main']['humidity']);
            $stmt->bindParam(':vento', $data['wind']['speed']);
            $stmt->bindParam(':sensacao', $data['main']['feels_like']);
            $stmt->bindParam(':min', $data['main']['temp_min']);
            $stmt->bindParam(':max', $data['main']['temp_max']);
            $stmt->bindParam(':descricao', $data['weather'][0]['description']);
            $stmt->bindParam(':icon', $data['weather'][0]['icon']);
            $stmt->execute();

            $id = $pdo->lastInsertId();

            $stmt = $pdo->prepare("INSERT INTO Historico (ClimaID, Cidade) VALUES (:idClima, :cidade);");
            $stmt->bindParam(':idClima', $id);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->execute();
        }

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
        exit;
    }
}

?>