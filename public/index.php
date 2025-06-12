<?php

use App\Component\Routing\Router;

require_once __DIR__ . '/../vendor/autoload.php';

function templatePart(string $name)
{
    $directory = __DIR__ . '/../templates/includes/';

    require_once $directory . $name; 
}

function internalServerError(): void
{
    http_response_code(500);
    exit;
}

function notFound(): void
{
    http_response_code(404);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router = new Router($method, $path);

$router->add('app_home', ['GET'], '/', 'DefaultController', 'home');
$router->add('app_login', ['GET', 'POST'], '/connexion', 'DefaultController', 'login');
$router->add('app_register', ['GET', 'POST'], '/inscription', 'DefaultController', 'register');
$router->add('app_profile', ['GET'], '/profil', 'DefaultController', 'profile');

$router->add('app_quiz_question', ['GET'], '/question', 'QuizController', 'question');
$router->add('app_quiz_waiting', ['GET'], '/quiz/en-attente', 'QuizController', 'waiting');
$router->add('app_quiz_score', ['GET'], '/quiz/score', 'QuizController', 'score');
$router->add('app_quiz_presenter', ['GET'], '/quiz/presentateur', 'QuizController', 'presenter');

$route = $router->getCurrentRoute();

if($route === null) {
    notFound();
}

$controllerFqcn = 'App\\Controller\\' . $route->getController();
if(!class_exists($controllerFqcn)) {
    internalServerError();
}

$controller = new $controllerFqcn();

if(!method_exists($controller, $route->getControllerMethod())) {
    internalServerError();
}

$response = $controller->{$route->getControllerMethod()}();

$templateDir = __DIR__ . '/../templates/';

$templateName = $response[0];
$context = $response[1] ?? null;

$template = $templateDir . $templateName;

if(!file_exists($template)) {
    internalServerError();
}

if($context !== null) {
    $count = extract($context, EXTR_SKIP);

    if($count !== count($context)) {
        internalServerError();
    }
}

require_once $template;