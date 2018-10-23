<?php
/**
 * Created by PhpStorm.
 * User: Ojciec Mateusz
 * Date: 23.10.2018
 * Time: 08:25
 */

class AppController{

    private $request = null;
    /**
     * AppController constructor.
     */
    public function __construct()
    {
        $this->request= strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(){
        return $this->request === 'get';
    }

    public function isPost(){
        return $this->request === 'post';
    }

    public function render(){

    }
}