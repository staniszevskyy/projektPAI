<?php

require_once('controllers/DefaultController.php');
require_once('controllers/AdminController.php');
require_once('controllers/MapController.php');

class Routing
{
    public $routes = [];

    public function __construct()
    {
        $this->routes = [
            'index' => [
                'controller' => 'DefaultController',
                'action' => 'index'
            ],
            'login' => [
                'controller' => 'DefaultController',
                'action' => 'login'
            ],
            'register' => [
                'controller' => 'DefaultController',
                'action' => 'register'
            ],
            'aboutUs' => [
                'controller' => 'DefaultController',
                'action' => 'aboutUs'
            ],
            'gain' => [
                'controller' => 'DefaultController',
                'action' => 'whatYouGain'
            ],
            'contact' => [
                'controller' => 'DefaultController',
                'action' => 'contactInfo'
            ],
            'map' => [
                'controller' => 'MapController',
                'action' => 'index'
            ],
            'admin' => [
                'controller' => 'AdminController',
                'action' => 'index'
            ],
            'admin_users' => [
                'controller' => 'AdminController',
                'action' => 'users'
            ],
            'admin_delete_user' => [
                'controller' => 'AdminController',
                'action' => 'userDelete'
            ]
        ];
    }

    public function run()
    {
        $page = isset($_GET['page'])
            && isset($this->routes[$_GET['page']]) ? $_GET['page'] : 'index';

        if ($this->routes[$page]) {
            $class = $this->routes[$page]['controller'];
            $action = $this->routes[$page]['action'];

            $object = new $class;
            $object->$action();
        }
    }

}