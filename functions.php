<?php


/**
 * функция, которая обрезает текстовое содержимое если оно превышает заданное число символов
 * @param string $description текстовое содержимое
 * @param string $append добавляется  в конец этой строки знак многоточия
 * @param string $read_more добавляется к итоговой строке тег с ссылкой «Читать далее»
 * @param integer $length заданное число символов
 * @return string Возвращает обрезанное  текстовое содержимое
 */

function truncate(
    string $description,
    string $append = "&hellip;",
    string $read_more = "<a class='post-text__more-link' href='#'>Читать далее</a>",
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
        return sprintf('<p>%s%s</p>%s', $words, $append, $read_more);
    }
}



