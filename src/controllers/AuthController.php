<?php
namespace App\Controllers;

use App\Utils\Auth;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController {
    public function index(Request $request, $parameters) {
        if (Auth::isAuthenticated()) {
            header('Location: /dashboard');
            exit;
        }

        $mode = $parameters['mode'] ?? 'login';
        $error = $_SESSION['auth_error'] ?? null;
        unset($_SESSION['auth_error']);

        ob_start();
        include __DIR__ . '/../../templates/pages/auth.twig';
        return new Response(ob_get_clean());
    }

    public function redirectToLogin(Request $request) {
        header('Location: /auth/login');
        exit;
    }

    public function process(Request $request, $parameters) {
        if ($request->getMethod() !== 'POST') {
            header('Location: /auth/login');
            exit;
        }

        $mode = $parameters['mode'];
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $name = $request->request->get('name');

        try {
            if ($mode === 'login') {
                Auth::login($email, $password);
            } else {
                Auth::signup($name, $email, $password);
            }
            header('Location: /dashboard');
            exit;
        } catch (\Exception $e) {
            $_SESSION['auth_error'] = $e->getMessage();
            header('Location: /auth/' . $mode);
            exit;
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        header('Location: /');
        exit;
    }
}