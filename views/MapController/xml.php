<?php



require_once (__DIR__.'/../../Database.php');

$database = new Database();
$doc = new DOMDocument('1.0');

$node = $doc->createElement("foodtrucks");
$node = $doc->appendChild($node);
$stmt = $database->connect()->prepare("SELECT * FROM foodtrucks WHERE 1");


header("Content-type: text/xml");


if ($stmt->execute()) {
    while ($row =  $stmt->fetch(PDO::FETCH_ASSOC)) {
        $newnode = $node->appendChild($doc->createElement('foodtruck'));
        $newnode->setAttribute('id', $row['id']);
        $newnode->setAttribute("name", $row['name']);
        $newnode->setAttribute("address", $row['address']);
        $newnode->setAttribute("lat", $row['lat']);
        $newnode->setAttribute("lng", $row['lng']);


    }
    $stmt=null;

    $XMLfile = $doc->saveXML();
    echo $XMLfile;
    }