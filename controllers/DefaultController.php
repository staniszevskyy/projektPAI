<?php

require_once "AppController.php";
require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/UserMapper.php';


class DefaultController extends AppController
{

    private $construct;

    public function __construct()
    {
        $this->construct = parent::__construct();
        $this->construct;
    }

    public function index()
    {
        $text = 'Hello there 👋';

        $this->render('home', ['text' => $text]);
    }

    public function login()
    {
        $mapper = new UserMapper();

        $user = null;

        if ($this->isPost()) {

            $user = $mapper->getUser($_POST['email']);

            if(!$user) {
                return $this->render('login', ['message' => ['Email not recognized']]);
            }

            if ($user->getPassword() !== $_POST['password']) {
                return $this->render('login', ['message' => ['Wrong password']]);
            } else {
                $_SESSION["id"] = $user->getEmail();
                $_SESSION["role"] = $user->getRole();

                $url = "http://$_SERVER[HTTP_HOST]/";
                header("Location: {$url}?page=index");
                exit();
            }
        }

        $this->render('login');
    }


    public function register()
    {
        if ($this->isPost()) {
            
            $validation = true;
            $user = $_POST['username'];
            $email = $_POST['email'];
            $emailSafe = filter_var($email, FILTER_SANITIZE_EMAIL);
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $haslo_hash = password_hash($pass1, PASSWORD_DEFAULT);

            if (strlen($user)<3 || strlen($user)>20)
            {

                $validation=false;
                $_SESSION['e_nick'] = "Nazwa użytkownika musi posiadać od 3 do 20 znaków";
            }
           
            if (ctype_alnum($user)==false)
            {

                $validation=false;
                $_SESSION['e_nick']="Nick moze skladac sie tylko z liter i cyfr(bez polskich znaków)";
            }

            
            
            if(filter_var($emailSafe, FILTER_VALIDATE_EMAIL)==false || $emailSafe!=$email)
            {

                $validation=false;
                $_SESSION['e_email']="Podaj poprawny adres e-mail";
            }

            if (strlen($pass1) <8 || strlen($pass2) >20)
            {

                $validation=false;
                $_SESSION['e_pass']="Hasło musi posiadać od 8 do 20 znaków";
            }

            if ($pass1 != $pass2)
            {

                $validation=false;
                $_SESSION['e_pass']="Podane hasla nie sa identyczne";

            }

            if (!(isset($_POST['accept']))){

                $validation=false;
                $_SESSION['e_accept']="Nie zaakceptowano regulaminu";
            }

            $_SESSION['r_user']=$user;
            $_SESSION['r_email']=$email;
            $_SESSION['r_pass1']=$pass1;
            $_SESSION['r_pass2']=$pass2;

            $mapper = new UserMapper();
            $user_db = $mapper->getUser($email);
            if ($user_db->getEmail() != null) {

                $validation=false;
                if ($user_db->getEmail() == $emailSafe)
                    $_SESSION['e_email'] = "Istnieje już użytkownik o zadanym adresie email";


            }
            $user_db = $mapper->getUserByNickname($user);

            if ($user_db->getNick() != null) {

                $validation=false;
                if ($user_db->getNick() == $user)
                    $_SESSION['e_nick'] = "Istnieje już użytkownik o zadanym loginie";
            }

            if ($validation == true ) {

                $mapper->addUser($user, $haslo_hash, $emailSafe, 0);
                $_SESSION['success'] = "Rejestracja zakończona powodzeniem!!!";
            }
        }

        $this->render('register');

        
    }

    public function aboutUs()
    {
        $this->render('aboutUs');
    }

    public function whatYouGain()
    {
        $this->render('gain');
    }

    public function contactInfo()
    {
        $this->render('contact');
    }
    public function logout()
    {
        session_unset();
        session_destroy();

        $this->render('index', ['text' => 'You have been successfully logged out!']);
    }
}