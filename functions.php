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
        return sprintf('<p>%s%s</p>%s', $words, "&hellip;", "<a class='post-text__more-link' href='#'>Читать далее</a>");
    }
}

/**
 *Показывает дату публикации поста в относительном формате,
 * удобном для пользователя. Т.е. вместо конкретной даты и времени
 * показывает эту же дату в виде количества прошедших с данного момента
 * минут, часов, дней, недель или месяцев.
 * @param string $postCreatedData время создания поста
 * @return string возвращает дату в виде количества прошедших с
 * данного момента минут, часов, дней, недель или месяцев.
 */

function getDateDiff(string $postCreatedData): string
{
    $dateNow = date_create();
    $datePostCreated = date_create($postCreatedData);
    //считает разницу с текущим временем
    // date_diff функция возвращает объект DateInterval
    $dateDifference = date_diff($datePostCreated, $dateNow);

    // https://www.php.net/manual/ru/class.dateinterval.php
    $months = $dateDifference->m;// Количество месяцев int
    $days = $dateDifference->d;// Количество дней int
    // Количество недель, округлённые  в меньшую сторону до ближайшего целого числа float
    // https://www.php.net/manual/ru/function.floor.php -- echo floor(9.999); // 9
    $weeks = floor($days / 7);
    $hours = $dateDifference->h;// Количество часов int
    $minutes = $dateDifference ->i;// Количество минут int

    // определяет, в какой из диапазонов она попадает, начиная от большого к меньшему
    if ($months) {
        return  $months . ' ' . get_noun_plural_form($months, 'месяц', 'месяца', 'месяцев') . ' назад';
    }
    if ($weeks) {
        return  $weeks . ' ' . get_noun_plural_form($weeks, 'неделя', 'недели', 'недель') . ' назад';
    }
    if ($days) {
        return  $days . ' ' . get_noun_plural_form($days, 'день', 'дня', 'дней') . ' назад';
    }
    if ($hours) {
        return  $hours . ' ' . get_noun_plural_form($hours, 'час', 'часа', 'часов') . ' назад';
    }
    if ($minutes) {
        return  $minutes . ' ' . get_noun_plural_form($minutes, 'минута', 'минуты', 'минут') . ' назад';
    }
}



