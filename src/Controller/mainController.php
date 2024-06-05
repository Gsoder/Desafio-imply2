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
        $cidade = $_POST['cidade'] ?? '';

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
            // Dados encontrados no banco de dados, retornar esses dados
            $data = [
                'temperatura' => $result['Temperatura'],
                'umidade' => $result['Umidade'],
                'vento' => $result['Vento'],
                'sensacao' => $result['Sensacao'],
                'descricao' => $result['Descricao']
            ];
        } else {
            // Dados não encontrados no banco de dados, chamar a API externa
            $weather = new getWeatherClass($this->apiKey);
            $data = $weather->getWeather($cidade);

            // Salvar os dados no banco de dados
            $stmt = $pdo->prepare("INSERT INTO Historico (ClimaID, Cidade) VALUES (:climaID, :cidade)");
            $stmt->bindParam(':climaID', $data['climaID']); 
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