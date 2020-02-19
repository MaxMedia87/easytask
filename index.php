<?php 
error_reporting(E_ALL);
session_start();
define('ACCESS', true);
$url = preg_replace('#^/#', '', $_SERVER['REQUEST_URI']);

$routes = [
    [
        'url' => '#^$|^\?#',
        'view' => 'task',
        'pagetitle' => 'Список задач'
    ]
];

foreach ($routes as $route) {
    if(preg_match($route['url'], $url, $matches)) {
        $view = $route['view'];
        $pagetitle = $route['pagetitle'];
        break;
    }
}

if(empty($matches)) {
    $pagetitle = 'Страница не найдена';
    header("HTTP/1.1 404 Not Found");
    include $_SERVER['DOCUMENT_ROOT'] . '/views/404.php';
    exit;
}
extract($matches);

include $_SERVER['DOCUMENT_ROOT'] . '/controllers/' . $view . '_controller.php';