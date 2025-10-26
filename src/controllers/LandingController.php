<?php
namespace App\Controllers;

use App\Utils\Auth;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LandingController {
    public function index(Request $request) {
        if (Auth::isAuthenticated()) {
            header('Location: /dashboard');
            exit;
        }

        ob_start();
        include __DIR__ . '/../../templates/pages/landing.twig';
        return new Response(ob_get_clean());
    }

    public function notFound(Request $request) {
        http_response_code(404);
        ob_start();
        include __DIR__ . '/../../templates/pages/notfound.twig';
        return new Response(ob_get_clean());
    }
}