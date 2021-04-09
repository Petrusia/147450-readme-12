<?php
$is_auth = rand(0, 1);
$user_name = 'Petras'; // укажите здесь ваше имя

// Таблица данных для показа карточки одного поста
$post_data = [
    [
        'title' => 'Полезный пост про Байкал',
        'type' => 'post-text',
        'description' => 'Озеро Байкал – огромное древнее озеро в горах Сибири к северу от монгольской границы. Байкал
        считается самым глубоким озером в мире. Он окружен сетью пешеходных маршрутов, называемых
        Большой байкальской тропой. Деревня Листвянка, расположенная на западном берегу озера, –
        популярная отправная точка для летних экскурсий. Зимой здесь можно кататься на коньках и
        собачьих упряжках.',
        'user_name' => 'Лариса',
        'avatar' => 'userpic-larisa-small.jpg',
    ],
    [
        'title' => 'Цитата',
        'type' => 'post-quote',
        'description' => 'Мы в жизни любим только раз, а после ищем лишь похожих',
        'user_name' => 'Лариса',
        'avatar' => 'userpic-larisa-small.jpg',
    ],
    [
        'title' => 'Игра престолов',
        'type' => 'post-text',
        'description' => 'Не могу дождаться начала финального сезона своего любимого сериала!',
        'user_name' => 'Владик',
        'avatar' => 'userpic.jpg',
    ],
    [
        'title' => 'Наконец, обработал фотки!',
        'type' => 'post-photo',
        'description' => 'rock-medium.jpg',
        'user_name' => 'Виктор',
        'avatar' => 'userpic-mark.jpg',
    ],
    [
        'title' => 'Моя мечта',
        'type' => 'post-photo',
        'description' => 'coast-medium.jpg',
        'user_name' => 'Лариса',
        'avatar' => 'userpic-larisa-small.jpg',
    ],
    [
        'title' => 'Лучшие курсы',
        'type' => 'post-link',
        'description' => 'www.htmlacademy.ru',
        'user_name' => 'Владик',
        'avatar' => 'userpic.jpg',
    ],
];
