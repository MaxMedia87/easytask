<?php
defined('ACCESS') or die('Доступ запрещен');
/**
* Функция возвращает запись из таблицы users по совпадению с логином
* @param подключение к БД
* @return возвращает массив
*/
function getUser($connect, $login = null) 
{
    if (empty($login)) {
        return;
    }
    if (!isset($_SESSION['auth']['login'])) {
        $sql = "SELECT * FROM users
            	WHERE login = '" . mysqli_real_escape_string($connect, $login) . "'";
    } else {
        $sql = "SELECT * FROM users
           		WHERE login = '{$_SESSION['auth']['login']}'
                LIMIT 1";        
    }
    $query = mysqli_query($connect, $sql);
    return mysqli_fetch_assoc($query);
}