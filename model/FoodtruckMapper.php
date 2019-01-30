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
            $stmt = $this->database->connect()->prepare("SELECT * FROM foodtrucks
            INNER JOIN addresses as a, open_hours as o
            WHERE addressFK=a.idaddresses AND openhoursFK=idopen_hours;");
            if ($stmt->execute()) {
                while ($row =  $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $address = $row['street'].', '.$row['city'].' '.$row['zipcode'];
                    $foodtruck = new Foodtruck($row['name'],$address, $row['lat'], $row['lng']);
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
//            $stmt = $this->database->connect()->prepare("SELECT * FROM foodtrucks WHERE name LIKE concat('%', :name, '%')
//            OR address LIKE concat('%', :name, '%')");

            $stmt = $this->database->connect()->prepare("SELECT * FROM foodtrucks
            INNER JOIN addresses as a, open_hours as o
            WHERE addressFK=a.idaddresses AND openhoursFK=idopen_hours
            AND name LIKE concat('%', :name, '%')");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);

            if ($stmt->execute()) {

                while ($row =  $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $address = $row['street'].', '.$row['city'].' '.$row['zipcode'];

                    $foodtruck = new Foodtruck($row['name'],$address, $row['lat'], $row['lng']);
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