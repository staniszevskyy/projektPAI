<?php

class Foodtruck
{
    private $name;
    private $address;
    private $lat;
    private $ltd;


    public function __construct($name, $address, $lat, $ltd)
    {
        $this->name = $name;
        $this->address = $address;
        $this->lat = $lat;
        $this->ltd = $ltd;
    }


    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getLat()
    {
        return $this->lat;
    }


    public function getLtd()
    {
        return $this->ltd;
    }




}