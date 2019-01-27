<?php
/**
 * Created by PhpStorm.
 * User: Ojciec Mateusz
 * Date: 27.01.2019
 * Time: 17:02
 */

class MapController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->render("map")   ;
    }

}