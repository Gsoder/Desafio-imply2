<?php

namespace Imply\DesafioImply2\Classes;

class dbClass
{
    private $host = 'db';
    private $db_name = 'ClimaDB';
    private $username = 'root';
    private $password = 'root';
    private $conexao;

    public function conectar() {
        $this->conexao = null;

        try {
            $this->conexao = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->conexao->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        } catch(\PDOException $e) { 
            echo 'Erro de conexão: ' . $e->getMessage();
        }

        return $this->conexao;
    }

    public function desconectar() {
        $this->conexao = null;
    }

}