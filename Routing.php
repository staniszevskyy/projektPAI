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
            'logout' => [
                'controller' => 'DefaultController',
                'action' => 'logout'
            ],
            'register' => [
                'controller' => 'DefaultController',
                'action' => 'register'
            ],
            'aboutUs' => [
                'controller' => 'DefaultController',
                'action' => 'aboutUs'
            ],

            'contact' => [
                'controller' => 'DefaultController',
                'action' => 'contactInfo'
            ],
            'map' => [
                'controller' => 'MapController',
                'action' => 'index'
            ],
            'xml' => [
                'controller' => 'MapController',
                'action' => 'xml'
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
            ],
            'search' => [
                'controller' => 'MapController',
                'action' => 'search'
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