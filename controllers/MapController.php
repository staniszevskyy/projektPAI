<?php
/**
 * Created by PhpStorm.
 * User: Ojciec Mateusz
 * Date: 27.01.2019
 * Time: 17:02
 */
require_once __DIR__.'/../model/FoodtruckMapper.php';

class MapController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $mapper =new FoodtruckMapper();
        $mapper->parseToXML();
//        $this->render("map");
    }



}