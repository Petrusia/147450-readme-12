<?php

/* функция, которая обрезает текстовое содержимое
если оно превышает заданное число символов */

function truncate($description, $length = 300)
{
    $description = trim($description);

    if (mb_strlen($description) <= $length) {
        return "<p>$description</p>";
    }


    $append = "&hellip;";
    $read_more = "<a class='post-text__more-link' href='#'>Читать далее</a>";
    $count = 0;

    // разбил текст на отдельные слова (по пробелам)
    $description = explode(' ', $description);

    //  в цикле последовательно считаю длину каждого слова и пробела
    foreach ($description as $key => $word) {
        $count += mb_strlen($word) + 1; // + 1 это пробел

        /* останавливаю  цикл, когда суммарная длина символов
         в посчитанных словах начинает превышать ограничение */
        if ($count > $length) {
            // обрезаю до приемлемой длины
            $abbreviation = array_slice($description, 0, $key);
            //  сложил  отдельные слова обратно в строку
            $description = implode(' ', $abbreviation);
            return "<p> $description $append </p> $read_more";
        }
    }
}
    //  другая версия

    // $description = substr($description, 0,  $length);
    // /*strrpos — Возвращает позицию последнего вхождения подстроки в строке
    //  у нас это пробел */
    // $position = strrpos($description, ' ');
    // $description = substr($description, 0, $position);
    // return "<p> $description $append </p> $read_more";



