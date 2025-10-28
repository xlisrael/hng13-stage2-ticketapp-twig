<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

session_start();

// Set up Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
    'debug' => true,
]);

$request = Request::createFromGlobals();
$path = $request->getPathInfo();

// Serve static files
if (preg_match('/\.(css|js|png|jpg|jpeg|gif|svg|ico)$/i', $path)) {
    $filePath = __DIR__ . $path;
    
    if (file_exists($filePath)) {
        $mimeTypes = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'ico' => 'image/x-icon'
        ];
        
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $mimeType = $mimeTypes[$extension] ?? 'text/plain';
        
        $response = new Response(file_get_contents($filePath));
        $response->headers->set('Content-Type', $mimeType);
        $response->send();
        exit;
    }
}

// Simple authentication check
function isAuthenticated() {
    return isset($_SESSION['user']);
}

// Routing
try {
    switch ($path) {
        case '/':
            echo $twig->render('pages/landing.twig');
            break;
            
        case '/auth/login':
            if ($request->getMethod() === 'POST') {
                $email = $request->request->get('email');
                $password = $request->request->get('password');
                
                // Simple demo authentication
                if ($email && $password) {
                    $_SESSION['user'] = [
                        'id' => '1',
                        'name' => 'Demo User',
                        'email' => $email
                    ];
                    header('Location: /dashboard');
                    exit;
                }
            }
            echo $twig->render('pages/auth.twig', ['mode' => 'login']);
            break;
            
        case '/auth/signup':
            if ($request->getMethod() === 'POST') {
                $name = $request->request->get('name');
                $email = $request->request->get('email');
                $password = $request->request->get('password');
                
                if ($name && $email && $password) {
                    $_SESSION['user'] = [
                        'id' => '2',
                        'name' => $name,
                        'email' => $email
                    ];
                    header('Location: /dashboard');
                    exit;
                }
            }
            echo $twig->render('pages/auth.twig', ['mode' => 'signup']);
            break;
            
        case '/logout':
            session_destroy();
            header('Location: /');
            exit;
            
        case '/dashboard':
            if (!isAuthenticated()) {
                header('Location: /auth/login');
                exit;
            }
            
            // Demo tickets data
            $tickets = $_SESSION['tickets'] ?? [];
            $stats = [
                'total' => count($tickets),
                'open' => count(array_filter($tickets, fn($t) => $t['status'] === 'open')),
                'in_progress' => count(array_filter($tickets, fn($t) => $t['status'] === 'in_progress')),
                'closed' => count(array_filter($tickets, fn($t) => $t['status'] === 'closed'))
            ];
            
            echo $twig->render('pages/dashboard.twig', [
                'user' => $_SESSION['user'],
                'stats' => $stats,
                'recentTickets' => array_slice($tickets, 0, 5)
            ]);
            break;
            
        case '/tickets':
            if (!isAuthenticated()) {
                header('Location: /auth/login');
                exit;
            }
            
            $tickets = $_SESSION['tickets'] ?? [];
            $message = $_SESSION['message'] ?? null;
            $error = $_SESSION['error'] ?? null;
            unset($_SESSION['message'], $_SESSION['error']);
            
            // Handle ticket creation
            if ($request->getMethod() === 'POST' && $request->request->has('title')) {
                $ticket = [
                    'id' => uniqid(),
                    'title' => $request->request->get('title'),
                    'description' => $request->request->get('description'),
                    'status' => $request->request->get('status'),
                    'priority' => $request->request->get('priority'),
                    'createdAt' => date('Y-m-d H:i:s')
                ];
                
                $tickets[] = $ticket;
                $_SESSION['tickets'] = $tickets;
                $_SESSION['message'] = 'Ticket created successfully!';
                header('Location: /tickets');
                exit;
            }
            
            echo $twig->render('pages/tickets.twig', [
                'tickets' => $tickets,
                'message' => $message,
                'error' => $error
            ]);
            break;
            
        case '/tickets/delete':
            if (!isAuthenticated()) {
                header('Location: /auth/login');
                exit;
            }
            
            if ($request->getMethod() === 'POST') {
                $id = $request->request->get('id');
                $tickets = $_SESSION['tickets'] ?? [];
                $tickets = array_filter($tickets, fn($t) => $t['id'] !== $id);
                $_SESSION['tickets'] = array_values($tickets);
                $_SESSION['message'] = 'Ticket deleted successfully!';
            }
            header('Location: /tickets');
            exit;
            
        default:
            http_response_code(404);
            echo $twig->render('pages/notfound.twig');
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}
