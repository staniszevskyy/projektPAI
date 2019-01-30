<?php



require_once (__DIR__.'/../../Database.php');

$database = new Database();
$doc = new DOMDocument('1.0');

$node = $doc->createElement("foodtrucks");
$node = $doc->appendChild($node);

$stmt = $database->connect()->prepare("SELECT * FROM foodtrucks
INNER JOIN addresses as a, open_hours as o
WHERE addressFK=a.idaddresses AND openhoursFK=idopen_hours;");


header("Content-type: text/xml");


if ($stmt->execute()) {
    while ($row =  $stmt->fetch(PDO::FETCH_ASSOC)) {
        $newnode = $node->appendChild($doc->createElement('foodtruck'));
        $newnode->setAttribute('id', $row['id']);
        $newnode->setAttribute("name", $row['name']);
        $newnode->setAttribute("lat", $row['lat']);
        $newnode->setAttribute("lng", $row['lng']);
        $newnode->setAttribute("street", $row['street']);
        $newnode->setAttribute("city", $row['city']);
        $newnode->setAttribute("zipcode", $row['zipcode']);
        $newnode->setAttribute("pon", $row['pon']);
        $newnode->setAttribute("wt", $row['wt']);
        $newnode->setAttribute("sr", $row['sr']);
        $newnode->setAttribute("czw", $row['czw']);
        $newnode->setAttribute("pt", $row['pt']);
        $newnode->setAttribute("sob", $row['sob']);
        $newnode->setAttribute("nd", $row['nd']);


    }
    $stmt=null;

    $XMLfile = $doc->saveXML();
    echo $XMLfile;
    }