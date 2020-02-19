<?php 
error_reporting(E_ALL);
ini_set('session.cookie_lifetime', 1200);
session_start();
define('ACCESS', true);
$url = preg_replace('#^/admin/#', '', $_SERVER['REQUEST_URI']);

$routes = [
    [
        'url' => '#^$|^\?#',
        'view' => 'task',
        'pagetitle' => 'Список задач'
    ],
    [
        'url'       => '#^login#',
        'view'      => 'auth', 
        'pagetitle' => 'Авторизация',
    ],
    [   'url'       => '#^edit|^edit/(\?task\=\d+)#', 
        'view'      => 'edit_task', 
        'pagetitle' => 'Редактирование задачи',
    ],
];

foreach ($routes as $route) {
    if(preg_match($route['url'], $url, $matches)) {
        $view = $route['view'];
        $pagetitle = $route['pagetitle'];
        break;
    }
}

if(empty($matches)) {
    header("HTTP/1.1 404 Not Found");
    $pagetitle = 'Страница не найдена';
    include $_SERVER['DOCUMENT_ROOT'] . '/admin/views/404.php';
    exit;
}

if(!isset($_SESSION['auth']['login'])) {
    $view = 'auth';
    $pagetitle = 'Авторизация';
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    setcookie('login', '', time() - 3600, '/');
    header('Location: /admin/login');
    exit;
}
extract($matches);

include $_SERVER['DOCUMENT_ROOT'] . '/admin/controllers/' . $view . '_controller.php';