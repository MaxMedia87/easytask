<?php 
defined('ACCESS') or die('Доступ запрещен');
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/models/' . $view . '_model.php';

if (isset($_GET['task'])) {
    $taskId = (int)$_GET['task'];
    $task = getTask($connect, $taskId);
    if (!$task) {
        header("HTTP/1.1 404 Not Found");
        include $_SERVER['DOCUMENT_ROOT'] . '/admin/views/404.php';
        exit;
    } else {
        $arrFields = [];
        if (isset($_GET['status_edit'])) {
            $arrFields['status_edit'] = $_GET['status_edit'];
            editTask($connect, $arrFields, $taskId);
        }
        $arrFields['name'] = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
        $arrFields['email'] = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
        $arrFields['message'] = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
        $errors = [];
        if (isset($_POST['send'])) {
            if (empty($arrFields['name']) || empty($arrFields['email']) || empty($arrFields['message'])) {
                $errors[] = 'Необходимо заполнить все поля';
            } elseif (!filter_var($arrFields['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Введите корретный email адрес';
            } else {
                if (editTask($connect, $arrFields, $taskId)) {
                    header("Location: /admin/");
                    exit;
                }
            }
        }
    }
}
include $_SERVER['DOCUMENT_ROOT'] . '/admin/views/' . $view . '.php';