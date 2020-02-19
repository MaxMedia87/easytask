<?php 
defined('ACCESS') or die('Доступ запрещен');
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/models/' . $view . '_model.php';

$arrFields = [];
$arrFields['name'] = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$arrFields['email'] = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$arrFields['message'] = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

$errors = [];
if (isset($_POST['send'])) {
    if (empty($arrFields['name']) || empty($arrFields['email']) || empty($arrFields['message'])) {
        $errors[] = 'Необходимо заполнить все поля';
        unset($_SESSION['task']['success']);
    } elseif (!filter_var($arrFields['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Введите корретный email адрес';
    } else {
        if (addTask($connect, $arrFields)) {
            $_SESSION['task']['success'] = 'Задача успешно создана';
            header("Location: /");
            exit;
        }
    }
}

$countPages = ceil(countRecords($connect) / $perpage);
if (!$countPages) {
    $countPages = 1;
}
if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
    if ($page < 1) {
        $page = 1;
    }
} else {
    $page = 1;
}
if ($page > $countPages) {
    $page = $countPages;
}
$startPage = ($page - 1) * $perpage;
$pagination = pagination($page, $countPages);

$tasks = getTasks($connect, $startPage, $perpage);

include $_SERVER['DOCUMENT_ROOT'] . '/views/' . $view . '.php';