<?php
namespace Application\Entities;

class Counteragent {
    private string $name;
    private string $ogrn;
    private string $address;

    public function getName()
    {
        return $name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getOgrn()
    {
        return $ogrn;
    }

    public function setOgrn($ogrn)
    {
        $this->ogrn = $ogrn;
    }

    public function getAddress()
    {
        return $address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }
}

