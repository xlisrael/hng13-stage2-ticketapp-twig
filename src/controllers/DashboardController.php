<?php
namespace App\Controllers;

use App\Utils\Auth;
use App\Utils\Storage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardController {
    public function index(Request $request) {
        if (!Auth::isAuthenticated()) {
            header('Location: /auth/login');
            exit;
        }

        $tickets = Storage::getTickets();
        $total = count($tickets);
        $open = count(array_filter($tickets, fn($t) => $t['status'] === 'open'));
        $resolved = count(array_filter($tickets, fn($t) => $t['status'] === 'closed'));
        $inProgress = count(array_filter($tickets, fn($t) => $t['status'] === 'in_progress'));

        $user = Auth::getUser();

        ob_start();
        include __DIR__ . '/../../templates/pages/dashboard.twig';
        return new Response(ob_get_clean());
    }
}