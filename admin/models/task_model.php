<?php
defined('ACCESS') or die('Доступ запрещен');
/**
* Функция вывода всех записей
* @param соединние с БД
*/
function getTasks($connect, $startPage, $perpage)
{
    $sql  = "SELECT * FROM tasks LIMIT $startPage, $perpage";
    $query = mysqli_query($connect, $sql);
    $arr = [];
    while ($data = mysqli_fetch_assoc($query)) {
       $arr[] = $data;
    }
    return $arr;
}
/**
* Функция возвращает число всех записей из таблицы
* @param соединние с БД
* @param таблица БД
*/
function countRecords($connect) 
{
    $sql = "SELECT COUNT(*) FROM tasks";
    $query = mysqli_query($connect, $sql);
    $countRecords = mysqli_fetch_row($query);
    return $countRecords[0];
}
/**
* Функция возвращает ссылки постраничной навигации в виде html
* @param текущая страница
* @param количество страниц
*/
function pagination($page, $countPages) 
{
    $uri = '?';
    if ($_SERVER['QUERY_STRING']) {
        foreach ($_GET as $key => $value) {
            if ($key != 'page') {
                $uri .= $key . '=' . $value . '&';
            }
        }
    }
    $out = '';
    for($i = 1; $i <= $countPages; $i++) {
        if ($i == $page) {
            $out .= '
            <li class="page-item active">
            <a class="page-link" href="' . $uri  . 'page=' . $i . '">' . $i . '<span class="sr-only"></span></a>
            </li>';
        } else {
            $out .= '<li class="page-item"><a class="page-link" href="' . $uri . 'page=' . $i . '">' . $i . '</a></li>';
        }
    }
    return $out;
}