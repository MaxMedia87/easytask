<?php
defined('ACCESS') or die('Доступ запрещен');

/**
* Функция возвращает массив 1 записи
* @param соединние с БД
* @param id записи таблицы
*/
function getTask($connect, $id) 
{
    $sql = "SELECT * FROM tasks WHERE id = '" . (int)$id . "'";
    $query = mysqli_query($connect, $sql);
    return mysqli_fetch_assoc($query);
}

/**
* Функция обновления записи в таблице
* @param соединние с БД
* @param массив полей
* @param id записи
*/
function editTask($connect, $arrFields, $id) 
{
    $sql = "UPDATE tasks SET";
    foreach ($arrFields as $key => $field) {
        $sql .= " $key = '" . mysqli_real_escape_string($connect, $field) . "',";
    }
    $sql = rtrim($sql, ',');
    $sql .= " WHERE id = '" . $id . "'";
    $query = mysqli_query($connect, $sql);
    return $query;
}
