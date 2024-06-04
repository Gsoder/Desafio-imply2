<?php

namespace Imply\DesafioImply2\Controller;

use Imply\DesafioImply2\Classes\GetCoordsClass;

class getCoordsController
{
    private $getCoords;

    public function __construct(GetCoordsClass $getCoords)
    {
        $this->getCoords = $getCoords;
    }

    public function getCoordinatesFromForm()
    {
        // Verifica se o parâmetro 'action' está presente
        if (!isset($_GET['action']) || $_GET['action'] !== 'getCoordinatesFromForm') {
            http_response_code(400); // Bad request
            return json_encode(['error' => 'Ação inválida']);
        }

        // Verifica se os dados do formulário foram recebidos
        if (!isset($_POST['estado']) || !isset($_POST['cidade'])) {
            http_response_code(400); 
            return json_encode(['error' => 'Dados do formulário incompletos']);
        }

        // Obtém os dados do formulário
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];

        try {
            // Obtém as coordenadas
            $coordinates = $this->getCoords->getCoordinates($estado, $cidade);

            // Verifica se as coordenadas foram obtidas com sucesso
            if ($coordinates === null) {
                http_response_code(500); // Internal server error
                return json_encode(['error' => 'Não foi possível obter as coordenadas']);
            }

            // Retorna as coordenadas como uma resposta JSON
            return json_encode($coordinates);
        } catch (\Exception $e) {
            http_response_code(500); // Internal server error
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}
