<?php

use App\Entity\User;

require_once __DIR__ . '/../vendor/autoload.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$template = match($path) {
    '/' => 'home.php',
    '/connexion' => 'login.php',
    '/inscription' => 'register.php',
    '/question' => 'question.php',
    '/profil' => 'profile.php',
    '/quiz/en-attente' => 'waiting_room.php',
    '/creation-quiz' => 'creation_quiz.php',
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