<?php

$isAuth = rand(0, 1);
$userName = 'Petras'; // укажите здесь ваше имя
$title = 'Популярное';

date_default_timezone_set('Europe/Vilnius');
require_once(__DIR__ . '/helpers.php');
require_once(__DIR__ . '/functions.php');

// В сценарии главной страницы выполните подключение к MySQL.
$connection = getConnection();
// Отправьте SQL-запрос для получения типов контента.
$contentTypes = getContentTypes($connection);
// Отправьте SQL-запрос для получения списка постов,
// объединенных с пользователями и отсортированный по популярности.
$posts = getPosts($connection);
// Используйте эти данные для показа списка постов
// и списка типов контента на главной странице.
$mainTemplate = include_template('main.php', ['contentTypes' => $contentTypes, 'posts' => $posts]);

$layoutTemplate = include_template(
    'layout.php',
    [
        'main_template' => $mainTemplate,
        'user_name' => $userName,
        'title' => $title,
        'is_auth' => $isAuth
    ]
);

print($layoutTemplate);
