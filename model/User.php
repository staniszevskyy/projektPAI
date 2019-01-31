<?php

class User
{
    private $nick;
    private $email;
    private $password;
    private $role;
    private $name;
    private $surname;

    public function __construct($email, $password, $role, $nick, $name, $surname)
    {

        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->nick = $nick;
        $this->name = $name;
        $this->surname = $surname;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }


    public function getRole()
    {
        return $this->role;
    }


    public function setRole($role): void
    {
        $this->role = $role;
    }


    public function getNick()
    {
        return $this->nick;
    }

    public function setNick($nick): void
    {
        $this->nick = $nick;
    }

  
    public function getName()
    {
        return $this->name;
    }


    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

   function setSurname($surname): void
    {
        $this->surname = $surname;
    }



}