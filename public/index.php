<?php 

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$template = match($path) {
    '/' => 'home.php',
    '/connexion' => 'login.php',
    '/inscription' => 'register.php',
    '/question-presentateur' => 'question-presenter.php',
    '/question-joueur' => 'question-player.php',
    default => null
};

if($template === null) {
    echo '404 not found';
}

$file = __DIR__ . '/../templates/' . $template;

if(!file_exists($file)) {
    echo 'Le fichier : ' . $file . ' n\'existe pas !';
}

require_once $file;