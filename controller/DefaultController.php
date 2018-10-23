<?php
/**
 * Created by PhpStorm.
 * User: Ojciec Mateusz
 * Date: 23.10.2018
 * Time: 08:25
 */

require_once("AppController.php");

class DefaultController extends AppController {


    /**
     * DefaultController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function login(string $fileName = null) {
        //renderowanie szablonu z katalogu views
        $view = $fileName ? dirname(__DIR__).'\view\\'.get_class($this).'\\'.$fileName.'.php' : '';

    }
}