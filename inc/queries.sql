-- Напишите запросы для добавления информации в БД:
-- 1. список типов контента для поста;
INSERT INTO content_type (type_name, class_name)
VALUES ('Цитаты', 'post-quote'),
       ('Ссылки', 'post-link'),
       ('Картинки', 'post-photo'),
       ('Видео', 'post-video'),
       ('Тексты', 'post-text');

-- 2. придумайте пару пользователей;
INSERT INTO user (email, login, password, avatar)
VALUES ('larisa@pochta.ru', 'Лариса', 'secret', 'userpic-larisa-small.jpg'),
       ('vladik@ochta.ru', 'Владик', 'secret', 'userpic.jpg'),
       ('viktor@pochta.ru', 'Виктор', 'secret', 'userpic-mark.jpg');

-- 3. существующий список постов;
INSERT INTO post (title, content, quote_author, image_url, video_url, link_url, views_number, user_id, content_type_id)
VALUES ('Полезный пост про Байкал',
        'Озеро Байкал – огромное древнее озеро в горах Сибири к северу от монгольской границы.
        Байкал считается самым глубоким озером в мире. Он окружен сетью пешеходных маршрутов,
        называемых Большой байкальской тропой. Деревня Листвянка,
        расположенная на западном берегу озера, –
        популярная отправная точка для летних экскурсий.
        Зимой здесь можно кататься на коньках и собачьих упряжках.',
        '', '', '', '', 12, '1', '5'),
       ('Цитата',
        'Мы в жизни любим только раз, а после ищем лишь похожих',
        'Неизвестный Автор', '', '', '', 15, '1', '1'),
       ('Игра престолов',
        'Не могу дождаться начала финального сезона своего любимого сериала!',
        '', '', '', '', 36, '2', '5'),
       ('Наконец, обработал фотки!',
        '', '', 'rock-medium.jpg', '', '', 45, '2', '3'),
       ('Моя мечта',
        '', '', 'coast-medium.jpg', '', '', 17, '3', '3'),
       ('Лучшие курсы',
        '', '', '', '', 'www.htmlacademy.ru', 17, '2', '3');


-- 4. придумайте пару комментариев к разным постам; https://yandex.ru/referats
INSERT INTO comment
SET content = 'Реформаторский пафос фонетически диссонирует подтекст. ',
    user_id = '1',
    post_id = '1';
INSERT INTO comment
SET content = 'Синхрония просветляет глубокий ритм.',
    user_id = '2',
    post_id = '2';

-- Напишите запросы для этих действий:
-- 1. получить список постов с сортировкой по популярности и вместе с именами авторов и типом контента;

SELECT user_id, content_type_id
FROM post
         INNER JOIN user ON post.user_id = user.id
         INNER JOIN content_type ON post.content_type_id = content_type.id
ORDER BY  views_number DESC;

-- 2. получить список постов для конкретного пользователя;
SELECT * FROM post WHERE user_id=1;

-- 3. получить список комментариев для одного поста, в комментариях должен быть логин пользователя;
SELECT content, user.login
FROM comment
         INNER JOIN user ON comment.user_id = user.id
WHERE comment.post_id = 1;

-- 4. добавить лайк к посту;
INSERT INTO user_post_like_relation SET user_id=1, post_id=1;

-- 5. подписаться на пользователя.
INSERT INTO subscription SET follower_id=1, user_id=2;
