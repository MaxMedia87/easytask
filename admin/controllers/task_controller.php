<?php
defined('ACCESS') or die('Доступ запрещен');
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/models/edit_task_model.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/models/' . $view . '_model.php';

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

if (isset($_GET['taskId'])) {
    $arrFields = [];
    $arrFields['status'] = isset($_GET['status']) ? $_GET['status'] : '';
    if (editTask($connect, $arrFields, (int)$_GET['taskId'])) {
        echo 'yes';
        exit;
    }
}

include $_SERVER['DOCUMENT_ROOT'] . '/admin/views/' . $view . '.php';