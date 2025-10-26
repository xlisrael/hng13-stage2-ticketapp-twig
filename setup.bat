@echo off
echo Setting up TicketApp Twig Project...

:: Create directory structure
mkdir assets\css
mkdir assets\js
mkdir assets\images
mkdir templates\layouts
mkdir templates\pages
mkdir templates\components
mkdir src\controllers
mkdir src\models
mkdir src\utils
mkdir config
mkdir public

:: Create composer.json
echo {
echo     "name": "hng/ticketapp-twig",
echo     "description": "Ticket Management App - Twig Version",
echo     "type": "project",
echo     "require": {
echo         "php": "^8.0",
echo         "twig/twig": "^3.0",
echo         "symfony/routing": "^6.0",
echo         "symfony/http-foundation": "^6.0"
echo     },
echo     "autoload": {
echo         "psr-4": {
echo             "App\\": "src/"
echo         }
echo     }
echo } > composer.json

:: Create basic public/index.php
echo ^<?php
echo require_once __DIR__ . '/../vendor/autoload.php';
echo.
echo // Basic routing for testing
echo $request = $_SERVER['REQUEST_URI'];
echo.
echo switch ($request) {
echo     case '/':
echo         echo "Home Page - Working!";
echo         break;
echo     case '/auth/login':
echo         echo "Login Page - Working!";
echo         break;
echo     default:
echo         http_response_code(404);
echo         echo "404 - Page not found";
echo         break;
echo }
echo ?^> > public\index.php

echo Setup complete! Now run: composer install