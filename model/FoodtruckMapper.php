<?php

require_once __DIR__.'/../Database.php';
require_once __DIR__.'/Foodtruck.php';

class FoodtruckMapper
{
    private $database;
    private $foodtruckList;

    public function __construct()
    {
        $this->database = new Database();
        $this->foodtruckList=array();

    }

    public function getAllFoodtrucks()
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM foodtrucks;');
            if ($stmt->execute()) {
                while ($row =  $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $foodtruck = new Foodtruck($row['name'],$row['address'], $row['lat'], $row['lng']);
                    $this->foodtruckList[] = $foodtruck;
                }
            }

        }
        catch(PDOException $e) {
            die();
        }
    }



    public function getCertainFoodtrucks($name)
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM foodtrucks WHERE name = :name;');
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            if ($stmt->execute()) {
                while ($row =  $stmt->fetch(PDO::FETCH_ASSOC))
                {

                    $foodtruck = new Foodtruck($row['name'],$row['address'], $row['lat'], $row['lng']);
                    $this->foodtruckList[] = $foodtruck;
                }
            }

        }
        catch(PDOException $e) {
            die();
        }
    }



    public function getFoodtruckList(): array
    {
        return $this->foodtruckList;
    }


}