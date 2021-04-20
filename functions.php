<?php


/**
 * функция, которая обрезает текстовое содержимое если оно превышает заданное число символов
 * @param string $description текстовое содержимое
 * @param integer $length заданное число символов
 * @return string Возвращает обрезанное  текстовое содержимое
 */

function truncate(
    string $description,
    int $length = 300
): string {
    //  выпилил  все html теги из текста
    $description = htmlspecialchars(trim($description));

    if (mb_strlen($description) <= $length) {
        return sprintf('<p>%s</p>', $description);
    }
    $words = ' ';
    // разбил текст на отдельные слова (по пробелам)
    $description = explode(' ', $description);
    //  в цикле последовательно считаю длину каждого слова
    foreach ($description as $word) {
        $words .= $word . ' ';
        if (mb_strlen($words) < $length) {
            continue;
        }
        return sprintf(
            '<p>%s%s</p>%s',
            $words,
            "&hellip;",
            "<a class='post-text__more-link' href='#'>Читать далее</a>"
        );
    }
}

/**
 *Показывает дату публикации поста в относительном формате, удобном для пользователя.
 * 1. $postCreatedDate время создания поста
 * 2. возвращает дату в виде количества прошедших с
 * данного момента минут, часов, дней, недель или месяцев.
 */

function getDateDiff(string $postCreatedDate): string
{
    $dateNow = date_create();
    $datePostCreated = date_create($postCreatedDate);
    //считает разницу с текущим временем
    /** @var DateInterval $dateDifference */
    $dateDifference = date_diff($datePostCreated, $dateNow);

    // https://www.php.net/manual/ru/class.dateinterval.php
    $months = $dateDifference->m;// Количество месяцев int
    $days = $dateDifference->d;// Количество дней int
    // Количество недель, округлённые  в меньшую сторону до ближайшего целого числа float
    // https://www.php.net/manual/ru/function.floor.php -- echo floor(9.999); // 9
    $weeks = floor($days / 7);
    $hours = $dateDifference->h;// Количество часов int
    $minutes = $dateDifference->i;// Количество минут int
    $date = ''; //возвращаемое значение

    // определяет, в какой из диапазонов она попадает, начиная от большого к меньшему
    if ($months) {
        $date = sprintf("%s %s назад", $months, get_noun_plural_form($months, 'месяц', 'месяца', 'месяцев'));
    }
    if ($weeks) {
        $date = sprintf("%s %s назад", $weeks, get_noun_plural_form($weeks, 'неделя', 'недели', 'недель'));
    }
    if ($days) {
        $date = sprintf("%s %s назад", $days, get_noun_plural_form($days, 'день', 'дня', 'дней'));
    }
    if ($hours) {
        $date = sprintf("%s %s назад", $hours, get_noun_plural_form($hours, 'час', 'часа', 'часов'));
    }
    if ($minutes) {
        $date = sprintf("%s %s назад", $minutes, get_noun_plural_form($minutes, 'минута', 'минуты', 'минут'));
    }
    return $date;
}

// В сценарии главной страницы выполните подключение к MySQL.

/**
 * @return mysqli
 */
function getConnection(): mysqli
{
    define('DB_HOST', 'mysql');
    define('DB_USER', 'readme');
    define('DB_PASSWORD', 'secret');
    define('DB_NAME', 'readmedb');

    $dbConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }
    return $dbConnection;
}

/**
 * @param mysqli $dbConnection
 * @return array
 */
function getContentTypes(mysqli $dbConnection): array
{
    $sqlQuerySelect = "SELECT * FROM content_type";
    $sqlQueryResult = mysqli_query($dbConnection, $sqlQuerySelect);

    if (!$sqlQueryResult) {
        echo mysqli_error($dbConnection);
    }
    return mysqli_fetch_all($sqlQueryResult, MYSQLI_ASSOC);
}

/**
 * @param mysqli $dbConnection
 * @return array
 */
function getPosts(mysqli $dbConnection): array
{
    $sqlQuerySelect = "SELECT * FROM post
        INNER JOIN user ON post.user_id = user.id
        INNER JOIN content_type ON post.content_type_id = content_type.id
        ORDER BY  views_number DESC";
    $sqlQueryResult = mysqli_query($dbConnection, $sqlQuerySelect);

    if (!$sqlQueryResult) {
        echo mysqli_error($dbConnection);
    }
    return mysqli_fetch_all($sqlQueryResult, MYSQLI_ASSOC);
}
