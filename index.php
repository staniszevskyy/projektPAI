
<?php


class Student {
var $surname;
var $name;
function __construct($surname, $name){
$this->surname = $surname;
$this->name = $name;
}
function setSurname($surname){$this->surname = $surname;}
function getName(){return $this->name;}}




