<?php
namespace App\Utils;

class Auth {
    const EXAMPLE_USER = ["id" => "user-1", "name" => "Excel Israel", "email" => "excel@example.com"];

    public static function isAuthenticated() {
        return !empty(Storage::getSession());
    }

    public static function login($email, $password) {
        // Mock validation; password can be anything with length >= 4
        if (!$email || !$password) {
            throw new \Exception("Email and password are required");
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Invalid email format");
        }
        
        if (strlen($password) < 4) {
            throw new \Exception("Invalid credentials");
        }
        
        // Success: save session token
        $token = bin2hex(random_bytes(16));
        $session = [
            'token' => $token, 
            'user' => array_merge(self::EXAMPLE_USER, ['email' => $email]),
            'createdAt' => time()
        ];
        Storage::setSession($session);
        return $session;
    }

    public static function signup($name, $email, $password) {
        if (!$name || !$email || !$password) {
            throw new \Exception("All fields are required");
        }
        
        // For demo, we accept signup and set session
        $token = bin2hex(random_bytes(16));
        $session = [
            'token' => $token, 
            'user' => ['id' => 'user-' . time(), 'name' => $name, 'email' => $email],
            'createdAt' => time()
        ];
        Storage::setSession($session);
        return $session;
    }

    public static function logout() {
        Storage::clearSession();
    }

    public static function getUser() {
        $session = Storage::getSession();
        return $session['user'] ?? null;
    }
}