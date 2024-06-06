<?php

namespace Imply\DesafioImply2\Model;

use DateTimeImmutable;

class historicoModel
{
    private climaModel $ClimaID;
    private string $Cidade;

    

    /**
     * Get the value of ClimaID
     */ 
    public function getClimaID()
    {
        return $this->ClimaID;
    }

    /**
     * Set the value of ClimaID
     *
     * @return  self
     */ 
    public function setClimaID(climaModel $ClimaID)
    {
        $this->ClimaID = $ClimaID;

        return $this;
    }

    /**
     * Get the value of Cidade
     */ 
    public function getCidade()
    {
        return $this->Cidade;
    }

    /**
     * Set the value of Cidade
     *
     * @return  self
     */ 
    public function setCidade($Cidade)
    {
        $this->Cidade = $Cidade;

        return $this;
    }

    public function toArray()
    {
        return [
            'cidade' => $this->getCidade(),
            'clima' => $this->ClimaID ? $this->ClimaID->toArray() : null
        ];
    }
}