<?php


namespace Imply\DesafioImply2\Controller;

use Imply\DesafioImply2\Classes\getWeatherClass;
use Imply\DesafioImply2\Classes\dbClass;
use Imply\DesafioImply2\Classes\sendEmailClass;
use Imply\DesafioImply2\Model\climaModel;
use Imply\DesafioImply2\Model\historicoModel;



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

        $data = new historicoModel();
        $clima = new climaModel();

        if ($result) {
            
            $clima->setTemperatura($result['Temperatura']);
            $clima->setMin($result['Min']);
            $clima->setMax($result['Max']);
            $clima->setVento($result['Vento'] * 3.6);
            $clima->setUmidade($result['Umidade']);
            $clima->setIcon($result['Icon']);
            $clima->setDescricao($result['Descricao']);
            $clima->setSensasao($result['Sensacao']);

            $data->setClimaID($clima);
            $data->setCidade($cidade);

            //var_dump($data);

        } else {
            $weather = new getWeatherClass($this->apiKey);
            $apiResponse = $weather->getWeather($cidade);

            $clima->setTemperatura($apiResponse['main']['temp']);
            $clima->setMin($apiResponse['main']['temp_min']);
            $clima->setMax($apiResponse['main']['temp_max']);
            $clima->setVento($apiResponse['wind']['speed'] * 3.6);
            $clima->setUmidade($apiResponse['main']['humidity']);
            $clima->setIcon($apiResponse['weather'][0]['icon']);
            $clima->setDescricao($apiResponse['weather'][0]['description']);
            $clima->setSensasao($apiResponse['main']['feels_like']);


            $stmt = $pdo->prepare("INSERT INTO Clima (Temperatura, Umidade, Vento, Sensacao, Descricao, Min, Max, Icon) VALUES (:temperatura, :umidade, :vento, :sensacao, :descricao, :min, :max, :icon);");
            $stmt->bindParam(':temperatura', $clima->getTemperatura());
            $stmt->bindParam(':umidade', $clima->getUmidade());
            $stmt->bindParam(':vento', $clima->getVento());
            $stmt->bindParam(':sensacao', $clima->getSensasao());
            $stmt->bindParam(':descricao', $clima->getDescricao());
            $stmt->bindParam(':min', $clima->getMin());
            $stmt->bindParam(':max', $clima->getMax());
            $stmt->bindParam(':icon', $clima->getIcon());
            $stmt->execute();
            
            $id = $pdo->lastInsertId();
            

            $data->setClimaID($clima);
            $data->setCidade($cidade);
            
            $stmt = $pdo->prepare("INSERT INTO Historico (ClimaID, Cidade) VALUES (:idClima, :cidade);");
            $stmt->bindParam(':idClima', $id);
            $stmt->bindParam(':cidade', $data->getCidade());
            $stmt->execute();
        
        }


        $this->sendResponse($data->toArray());
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