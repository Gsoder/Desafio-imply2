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
        $stmt = $pdo->prepare("SELECT c.Temperatura, c.Umidade, c.Vento, c.Sensacao, c.Descricao
                               FROM Historico h
                               INNER JOIN Clima c ON h.ClimaID = c.ID
                               WHERE h.Cidade = :cidade AND h.DataHora >= DATE_SUB(NOW(), INTERVAL 1 HOUR)");
        $stmt->bindParam(':cidade', $cidade);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            $data = [
                'temperatura' => $result['Temperatura'],
                'umidade' => $result['Umidade'],
                'vento' => $result['Vento'],
                'sensacao' => $result['Sensacao'],
                'descricao' => $result['Descricao']
            ];
        } else {
            $weather = new getWeatherClass($this->apiKey);
            $data = $weather->getWeather($cidade);
/*
            $stmt = $pdo->prepare("INSERT INTO Clima(Temperatura, Umidade, Vento, Sensacao, Descricao) VALUES (:termperatura, :umidade, :vento, :sensacao, 'test');");
            
            $stmt->bindParam(':termperatura', $data['main']['temp']); 
            $stmt->bindParam(':umidade', $data['main']['humidity']); 
            $stmt->bindParam(':vento', $data['wind']['speed']); 
            $stmt->bindParam(':sensacao', $data['main']['feels_like']); 
            $stmt->execute();

            $id = $pdo->prepare("SELECT ID FROM Clima WHERE ID = LAST_INSERT_ID()");
            $id->execute();
         

            $stmt = $pdo->prepare("INSERT INTO Historico(ClimaID, Cidade) VALUES (:idCLima, :cidade);");
            
            $stmt->bindParam(':idCLima', $id['ID']); 
            $stmt->bindParam(':cidade', $cidade); 
            $stmt->execute();

*/
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