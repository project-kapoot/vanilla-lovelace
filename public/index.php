<?php 

$path = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$path = $path === '' ? '/' : $path;


$template = match($path) {
    '/' => 'home.php',
    '/connexion' => 'login.php',
    '/inscription' => 'register.php',
    '/question-presentateur' => 'question-presenter.php',
    '/question-joueur' => 'question-player.php',
    '/profil' => 'profile.php',
    default => null
};

if ($template === null || !file_exists(__DIR__ . '/../templates/' . $template)) {
    http_response_code(404);
    require_once __DIR__ . '/../templates/errors/404.php';
    exit;
}

$file = __DIR__ . '../templates/' . $template;

if(!file_exists($file)) {
    echo 'Le fichier : ' . $file . ' n\'existe pas !';
}

function templatePart(string $name) {
    $directory = __DIR__ . '/../templates/includes/';

    require_once $directory . $name; 
}

require_once $file;