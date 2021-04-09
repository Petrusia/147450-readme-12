<?php

/**
 * функция, которая обрезает текстовое содержимое если оно превышает заданное число символов
 * @param string $description текстовое содержимое
 * @param integer $length заданное число символов
 * @return string Возвращает обрезанное  текстовое содержимое
 */

function truncate(string $description, int $length = 300): string
{
    //  выпилил  все html теги из текста
    $description = htmlspecialchars(trim($description));

    if (mb_strlen($description) <= $length) {
        // return "<p>{$description}</p>";
        return sprintf('<p>%s</p>', $description);
    }

    $append = "&hellip;";
    $read_more = "<a class='post-text__more-link' href='#'>Читать далее</a>";
    $count = 0;
    $content = ' ';

    // разбил текст на отдельные слова (по пробелам)
    $description = explode(' ', $description);

    //  в цикле последовательно считаю длину каждого слова и пробела
    foreach ($description as $key => $word) {
        $count += mb_strlen($word) + 1; // + 1 это пробел
        //остановил  цикл, когда суммарная длина символов
        // в посчитанных словах начинает превышать ограничение
        if ($count <= $length) {
            continue;
        }

        // к ключу я добавил единицу,
        //потому что массив отсчитывает от 0, а слова - от 1.
        $key = $key + 1;
        // обрезал до приемлемой длины
        $abbreviation = array_slice($description, 0, $key);
        //  сложил  отдельные слова обратно в строку
        $content = implode(" ", $abbreviation);
        break;
    }
    return sprintf('<p>%s%s</p>%s', $content, $append, $read_more);
}


