<?php

$isAuth = rand(0, 1);
$userName = 'Petras'; // укажите здесь ваше имя
$title = 'Популярное';

date_default_timezone_set('Europe/Vilnius');
require_once(__DIR__ . '/helpers.php');
require_once(__DIR__ . '/functions.php');
// 2. В сценарий этой странице добавьте условие на проверку существования параметра запроса
// и получение его значения.
$typeIdFromQuery = intval($_GET['type_id'] ?? 0);
// В сценарии главной страницы выполните подключение к MySQL.
$db = getConnection();
// Отправьте SQL-запрос для получения типов контента.
$contentTypes = getContentTypes($db);
// Отправьте SQL-запрос для получения списка постов,
// объединенных с пользователями и отсортированный по популярности.
$posts = getPosts($db, $typeIdFromQuery);
// Используйте эти данные для показа списка постов
// и списка типов контента на главной странице.

$mainTemplate = include_template(
    'main.php',
    [
        'contentTypes' => $contentTypes,
        'posts' => $posts,
        'typeIdFromQuery' => $typeIdFromQuery,
    ]
);

$layoutTemplate = include_template(
    'layout.php',
    [
        'main_template' => $mainTemplate,
        'user_name' => $userName,
        'title' => $title,
        'is_auth' => $isAuth,
    ]
);

print($layoutTemplate);
