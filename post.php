<?php

$isAuth = rand(0, 1);
$userName = 'Petras'; // укажите здесь ваше имя
$title = 'readme: публикация';

date_default_timezone_set('Europe/Vilnius');
require_once(__DIR__ . '/helpers.php');
require_once(__DIR__ . '/functions.php');
$db = getConnection();

// 3. Проверяйте существование параметра запроса с id поста.
$postIdFromQuery =($_GET['post_id'] ?? 0);
//Сформируйте и выполните SQL на чтение записи из таблицы с постами,
// где id поста равен полученному из параметра запроса.
$post = getPost($db, $postIdFromQuery);
$comments = getComments($db, $postIdFromQuery) ?? 'Комментариев нет ';
$comments = !empty($comments ) ? $comments : 'Комментариев нет ';
$numberOfSubscribers = getNumberOfSubscribers ($db, $post['user_id']);
$textOfSubscribers = getNumberOfSubscribers ($db, $post['user_id'], false);
$numberOfPublications = getNumberOfPublications  ($db, $post['user_id']);
$textOfPublications = getNumberOfPublications  ($db, $post['user_id'], false);
$numberOfComments = getNumberOfComments($db, $post['id']);
$numberOfLikes = getNumberOfLikes($db, $post['id']);


$postTemplate = include_template(
    'post/details.php',
    [
        'post' => $post,
        'postIdFromQuery' => $postIdFromQuery,
        'numberOfSubscribers' => $numberOfSubscribers,
        'textOfSubscribers' => $textOfSubscribers,
        'numberOfPublications' => $numberOfPublications,
        'textOfPublications' => $textOfPublications,
        'comments' => $comments,
        'numberOfComments' => $numberOfComments,
        'numberOfLikes' => $numberOfLikes
    ]
);

$layoutTemplate = include_template(
    'post/layout.php',
    [
        'postTemplate' => $postTemplate,
        'user_name' => $userName,
        'title' => $title,
        'is_auth' => $isAuth,
    ]
);

print($layoutTemplate);



