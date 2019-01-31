<?php

class Foodtruck
{
    private $name;
    private $address;
    private $lat;
    private $ltd;
    public $food;

    public function __construct($name, $address, $lat, $ltd)
    {
        $this->name = $name;
        $this->address = $address;
        $this->lat = $lat;
        $this->ltd = $ltd;
        $this->food=array();
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


    public function getFood()
    {
        return $this->food;
    }



    public function addFood($name, $price)
    {
        $this->food[$name] = $price;

    }


}