<?php
defined('ACCESS') or die('Доступ запрещен');
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/models/' . $view . '_model.php';

if (isset($_SESSION['auth']['login'])) {
    header('Location: /admin');
    exit;
}
$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';
$errors = [];
if (isset($_POST['send'])) {
	if (empty($login) || empty($password)) {
	    $errors[] = "Поля логин/пароль обязательны к заполнению";
	} else {
	    $user = getUser($connect, $login);
	    if ($user !== null && password_verify($password, $user['password'])) {
	        if (!isset($_SESSION['login'])) {
	            setcookie('login', $login, time() + 60 * 60 * 24 * 30, '/');
	            $_SESSION['auth']['login'] = $login;
	            $_SESSION['auth']['userId'] = $user['id'];
	        }
	        if (isset($_COOKIE['login'])) {
	            setcookie('login', $_COOKIE['login'], time() + 60 * 60 * 24 * 30, '/');
	        }
	        header('Location: /admin/');
	        exit;
	    } else {
	        $errors[] = "Поля логин/пароль введены не верно";
	    }
	}
}

include $_SERVER['DOCUMENT_ROOT'] . '/admin/views/' . $view . '.php';