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

            foreach ($this->foodtruckList as $key => $value) {

                $stmt2 = $this->database->connect()->prepare(
                    "SELECT f.name, f.price FROM food f, foodtrucks fo, foodlist l
                      WHERE l.foodFK=f.idfood AND l.foodtruckFK=fo.id AND fo.name = :name;");
                $name = $value->getName();

                $stmt2->bindParam(':name', $name, PDO::PARAM_STR);

                if ($stmt2->execute()) {


                    while ($row = $stmt2->fetch(PDO::FETCH_NUM)) {

                        $value->addFood($row[0], $row[1]);

                    }
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