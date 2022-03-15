<?php
class N_People
{

    private $id_people;
    private $id_plan;
    private $name;
    private $mother_name;
    private $email;
    private $tel_fix;
    private $tel_cel;
    private $birthdate;
    private $cpf;
    private $rg;
    private $from;
    private $sexo;
    private $marital_status;
    private $type_register;

    public function setIdPeople($id_people = 0)
    {
        $this->id_people = $id_people;
    }
    public function setIdPlan($id_plan = null)
    {
        $this->id_plan = $id_plan;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function setMotherName(string $mother_name)
    {
        $this->mother_name = $mother_name;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function setTelFix(string $tel_fix)
    {
        $this->tel_fix = $tel_fix;
    }
    public function setTelCel(string $tel_cel)
    {
        $this->tel_cel = $tel_cel;
    }
    public function setBirthDate(string $birthdate)
    {
        $this->birthdate = $birthdate;
    }
    public function setCpf(string $cpf)
    {
        $this->cpf = $cpf;
    }
    public function setRg(string $rg)
    {
        $this->rg = $rg;
    }
    public function setFrom(string $from)
    {
        $this->from = $from;
    }
    public function setSexo(string $sexo)
    {
        $this->sexo = $sexo;
    }
    public function setMaritalStatus(string $marital_status)
    {
        $this->marital_status = $marital_status;
    }
    public function setTypeReister(string $type_register)
    {
        $this->type_register = $type_register;
    }

    public function getIdPeople()
    {
        return $this->id_people;
    }
    public function getIdPlan()
    {
        return $this->id_plan;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getMotherName()
    {
        return $this->mother_name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getTelFix()
    {
        return $this->tel_fix;
    }
    public function getTelCel()
    {
        return $this->tel_cel;
    }
    public function getBirthDate()
    {
        return $this->birthdate;
    }
    public function getCpf()
    {
        return $this->cpf;
    }
    public function getRg()
    {
        return $this->rg;
    }
    public function getFrom()
    {
        return $this->from;
    }
    public function getSexo()
    {
        return $this->sexo;
    }
    public function getMaritalStatus()
    {
        return $this->marital_status;
    }
    public function getTypeReister()
    {
        return $this->type_register;
    }
}