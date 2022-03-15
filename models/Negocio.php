<?php
/**
 * @author Alenilson Souza
 * @copyright 2020
 */
class Negocio 
{
    private $id;
    private $name;

    public function setId(int $id) 
    {
        $this->id = $id;
    }

    public function setName(string $name) 
    {   
        $lowerName = strtolower($name);
        $this->name = ucwords($lowerName);
    }

    public function getId():int
    {
        return $this->id;
    }

    public function getName():string
    {
        return $this->name;
    }
}