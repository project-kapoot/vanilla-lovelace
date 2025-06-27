<?php

use App\Component\Database\Connection;
use App\Component\Routing\Router;

require_once __DIR__ . '/../vendor/autoload.php';

define('TEMPLATE_DIR', __DIR__ . '/../templates/');

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

$router->add('app_quiz_question', ['GET'], '/quiz/([0-9]+)/question', 'QuizController', 'question');
$router->add('app_quiz_waiting', ['GET'], '/quiz/([0-9]+)/en-attente', 'QuizController', 'waiting');
$router->add('app_quiz_score', ['GET'], '/quiz/([0-9]+)/score', 'QuizController', 'score');
$router->add('app_quiz_presenter', ['GET'], '/quiz/([0-9]+)/presentateur', 'QuizController', 'presenter');

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

$params = $route->getParams();

$response = $controller->{$route->getControllerMethod()}();

$template = TEMPLATE_DIR . $response[0];
$context = $response[1] ?? null;

if($context !== null) {
    $count = extract($context, EXTR_SKIP);

    if($count !== count($context)) {
        internalServerError();
    }
}

$baseTemplate = TEMPLATE_DIR . 'base.php';

if(!file_exists($baseTemplate)) {
    internalServerError();
}

require_once $baseTemplate;