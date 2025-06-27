<?php

use App\Component\Database\Connection;
use App\Entity\User;

require_once __DIR__ . '/../vendor/autoload.php';

$databaseConnectionFailed = function(Throwable $exception) {
    if(!($exception instanceof PDOException)) {
        return;
    }

    http_response_code(500);
    exit;
};

$globalExceptionHandler = function(Throwable $exception) {
    http_response_code(500);
    exit;
};

$exceptionHandlers = [
    $databaseConnectionFailed,
    $globalExceptionHandler,
];

set_exception_handler(function(Throwable $exception) use ($exceptionHandlers) {
    foreach($exceptionHandlers as $exceptionHandler) 
    {
        $exceptionHandler($exception);
    }
});

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$connection = new Connection($_ENV['DATABASE_DSN'], $_ENV['DATABASE_USERNAME'], $_ENV['DATABASE_PASSWORD']);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$template = match($path) {
    '/' => 'home.php',
    '/connexion' => 'login.php',
    '/inscription' => 'register.php',
    '/question' => 'question.php',
    '/profil' => 'profile.php',
    '/quiz/en-attente' => 'waiting_room.php',
    '/quiz/score' => 'score.php',
    '/quiz/presentateur' => 'presentateur.php',
    default => null
};

if($template === null) {
    echo '404 not found';
}

$file = __DIR__ . '/../templates/' . $template;

if(!file_exists($file)) {
    echo 'Le fichier : ' . $file . ' n\'existe pas !';
}

function templatePart(string $name) {
    $directory = __DIR__ . '/../templates/includes/';

    require_once $directory . $name; 
}

$roles = [
    'player',
    'presenter',
];

$role = $roles[0];
$user = new User([$roles[1]]);

require_once $file;