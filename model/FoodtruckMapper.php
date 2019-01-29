<?php

require_once __DIR__.'/../Database.php';

class FoodtruckMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function parseToXML()
    {
        $doc = new DOMDocument('1.0');

        $node = $doc->createElement("foodtrucks");
        $node = $doc->appendChild($node);
        $stmt = $this->database->connect()->prepare("SELECT * FROM foodtrucks WHERE 1");


        header("Content-type: text/xml");


        if ($stmt->execute()) {
    while ($row =  $stmt->fetch(PDO::FETCH_ASSOC)) {
        $newnode = $node->appendChild($doc->createElement('foodtruck'));
        $newnode->appendChild($doc->createElement("id", $row['id']));
        $newnode->appendChild($doc->createElement("name", $row['name']));
        $newnode->appendChild($doc->createElement("address", $row['address']));
        $newnode->appendChild($doc->createElement("lat", $row['lat']));
        $newnode->appendChild($doc->createElement("lng", $row['lng']));

    }
    $stmt=null;

    $XMLfile = $doc->saveXML();
    echo $XMLfile;
}
}
}