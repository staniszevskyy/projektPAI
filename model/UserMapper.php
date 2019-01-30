<?php

require_once 'User.php';
require_once __DIR__.'/../Database.php';

class UserMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }


    public function addUser($user, $haslo, $email, $role){

        $data = [
            'email' => $email,
            'pass' => $haslo,
            'role' => $role,
            'user' => $user,
        ];

        $stmt = $this->database->connect()->prepare('INSERT INTO users (email, password, role, nick) VALUES (:email, :pass, :role, :user);');
        $stmt->execute($data);


    }

    public function getUser(
        string $email
    ):User {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM users WHERE email = :email;');
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->connection = null;
            return new User($user['name'], $user['surname'], $user['email'], $user['password'], $user['role'], $user['nick']);
        }
        catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getUserByNickname(string $nick): User{
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM users WHERE nick = :nick;');
            $stmt->bindParam(':nick', $nick, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            return new User($user['name'], $user['surname'], $user['email'], $user['password'], $user['role'], $user['nick']);
        }
        catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getUsers()
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM users WHERE email != :email;');
            $stmt->bindParam(':email', $_SESSION['id'], PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $user;
        }
        catch(PDOException $e) {
            die();
        }
    }

    public function delete(int $id): void
    {
        try {
            $stmt = $this->database->connect()->prepare('DELETE FROM users WHERE id = :id;');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

        }
        catch(PDOException $e) {
            die();
        }
    }
}