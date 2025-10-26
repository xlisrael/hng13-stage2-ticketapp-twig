<?php
namespace App\Controllers;

use App\Utils\Auth;
use App\Utils\Storage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TicketsController {
    public function index(Request $request) {
        if (!Auth::isAuthenticated()) {
            header('Location: /auth/login');
            exit;
        }

        $tickets = Storage::getTickets();
        $message = $_SESSION['ticket_message'] ?? null;
        $error = $_SESSION['ticket_error'] ?? null;
        unset($_SESSION['ticket_message'], $_SESSION['ticket_error']);

        ob_start();
        include __DIR__ . '/../../templates/pages/tickets.twig';
        return new Response(ob_get_clean());
    }

    public function create(Request $request) {
        if (!Auth::isAuthenticated()) {
            header('Location: /auth/login');
            exit;
        }

        if ($request->getMethod() !== 'POST') {
            header('Location: /tickets');
            exit;
        }

        $ticket = [
            'title' => $request->request->get('title'),
            'description' => $request->request->get('description'),
            'status' => $request->request->get('status'),
            'priority' => $request->request->get('priority')
        ];

        try {
            // Validation
            if (empty($ticket['title'])) {
                throw new \Exception("Title is required");
            }
            if (!in_array($ticket['status'], ['open', 'in_progress', 'closed'])) {
                throw new \Exception("Invalid status");
            }

            Storage::createTicket($ticket);
            $_SESSION['ticket_message'] = "Ticket created successfully";
        } catch (\Exception $e) {
            $_SESSION['ticket_error'] = $e->getMessage();
        }

        header('Location: /tickets');
        exit;
    }

    public function edit(Request $request, $parameters) {
        if (!Auth::isAuthenticated()) {
            header('Location: /auth/login');
            exit;
        }

        if ($request->getMethod() !== 'POST') {
            header('Location: /tickets');
            exit;
        }

        $id = $parameters['id'];
        $changes = [
            'title' => $request->request->get('title'),
            'description' => $request->request->get('description'),
            'status' => $request->request->get('status'),
            'priority' => $request->request->get('priority')
        ];

        try {
            Storage::updateTicket($id, $changes);
            $_SESSION['ticket_message'] = "Ticket updated successfully";
        } catch (\Exception $e) {
            $_SESSION['ticket_error'] = $e->getMessage();
        }

        header('Location: /tickets');
        exit;
    }

    public function delete(Request $request, $parameters) {
        if (!Auth::isAuthenticated()) {
            header('Location: /auth/login');
            exit;
        }

        $id = $parameters['id'];
        
        try {
            Storage::deleteTicket($id);
            $_SESSION['ticket_message'] = "Ticket deleted successfully";
        } catch (\Exception $e) {
            $_SESSION['ticket_error'] = $e->getMessage();
        }

        header('Location: /tickets');
        exit;
    }
}