<?php

namespace Imply\DesafioImply2\Model;

class climaModel
{
    public $Temperatura;
    public $Min;
    public $Max;
    public $Vento;
    public $Umidade;
    public $Icon;
    public $Descricao;
    public $Sensasao;

    /**
     * Get the value of Temperatura
     */ 
    public function getTemperatura()
    {
        return $this->Temperatura;
    }

    /**
     * Set the value of Temperatura
     *
     * @return  self
     */ 
    public function setTemperatura($Temperatura)
    {
        $this->Temperatura = $Temperatura;

        return $this;
    }

    /**
     * Get the value of Min
     */ 
    public function getMin()
    {
        return $this->Min;
    }

    /**
     * Set the value of Min
     *
     * @return  self
     */ 
    public function setMin($Min)
    {
        $this->Min = $Min;

        return $this;
    }

    /**
     * Get the value of Max
     */ 
    public function getMax()
    {
        return $this->Max;
    }

    /**
     * Set the value of Max
     *
     * @return  self
     */ 
    public function setMax($Max)
    {
        $this->Max = $Max;

        return $this;
    }

    /**
     * Get the value of Vento
     */ 
    public function getVento()
    {
        return $this->Vento;
    }

    /**
     * Set the value of Vento
     *
     * @return  self
     */ 
    public function setVento($Vento)
    {
        $this->Vento = $Vento;

        return $this;
    }

    /**
     * Get the value of Umidade
     */ 
    public function getUmidade()
    {
        return $this->Umidade;
    }

    /**
     * Set the value of Umidade
     *
     * @return  self
     */ 
    public function setUmidade($Umidade)
    {
        $this->Umidade = $Umidade;

        return $this;
    }

    /**
     * Get the value of Icon
     */ 
    public function getIcon()
    {
        return $this->Icon;
    }

    /**
     * Set the value of Icon
     *
     * @return  self
     */ 
    public function setIcon($Icon)
    {
        $this->Icon = $Icon;

        return $this;
    }

    /**
     * Get the value of Descricao
     */ 
    public function getDescricao()
    {
        return $this->Descricao;
    }

    /**
     * Set the value of Descricao
     *
     * @return  self
     */ 
    public function setDescricao($Descricao)
    {
        $this->Descricao = $Descricao;

        return $this;
    }

    /**
     * Get the value of Sensasao
     */ 
    public function getSensasao()
    {
        return $this->Sensasao;
    }

    /**
     * Set the value of Sensasao
     *
     * @return  self
     */ 
    public function setSensasao($Sensasao)
    {
        $this->Sensasao = $Sensasao;

        return $this;
    }

    public function toArray()
    {
        return [
            'temperatura' => $this->getTemperatura(),
            'min' => $this->getMin(),
            'max' => $this->getMax(),
            'vento' => $this->getVento(),
            'umidade' => $this->getUmidade(),
            'icon' => $this->getIcon(),
            'descricao' => $this->getDescricao(),
            'sensacao' => $this->getSensasao()
        ];
    }
}