<?php

require_once __DIR__ . '/Database.php';

class User {
    private $db;

    public function __construct() {
        try {
            $this->db = Database::getInstance()->getConnection();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function register($username, $email, $password) {
        if (empty($username) || empty($email) || empty($password)) {
            throw new Exception("All fields are required");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $this->db->prepare(
                "INSERT INTO usuarios (username, email, password) VALUES (:username, :email, :password)"
            );

            $stmt->execute([
                ":username" => $username,
                ":email" => $email,
                ":password" => $passwordHash
            ]);

            return "User registered successfully";

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                throw new Exception("Username or email already exists");
            }
            throw new Exception("Error registering user");
        }
    }

    public function login($identifier, $password) {
        if (empty($identifier) || empty($password)) {
            throw new Exception("All fields are required");
        }

        $field = strpos($identifier, '@') !== false ? 'email' : 'username';

        try {
            $stmt = $this->db->prepare(
                "SELECT username, password FROM usuarios WHERE $field = :identifier"
            );

            $stmt->execute([
                ":identifier" => $identifier
            ]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                throw new Exception("User not found");
            }

            if (!password_verify($password, $user['password'])) {
                throw new Exception("Incorrect password");
            }

            return $user['username'];

        } catch (PDOException $e) {
            throw new Exception("Error logging in");
        }
    }

    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT username, email FROM usuarios WHERE username = :username");
        $stmt->execute([":username" => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUsername($currentUsername, $newUsername) {
        if (empty($newUsername)) {
            throw new Exception("Username cannot be empty");
        }

        try {
            $stmt = $this->db->prepare("UPDATE usuarios SET username = :new WHERE username = :current");
            $stmt->execute([":new" => $newUsername, ":current" => $currentUsername]);
            return "Username updated successfully";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                throw new Exception("Username already exists");
            }
            throw new Exception("Error updating username");
        }
    }
}