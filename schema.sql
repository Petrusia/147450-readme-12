DROP TABLE IF EXISTS user;
CREATE TABLE  user
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email      VARCHAR(128) NOT NULL UNIQUE,
    login      VARCHAR(128) NOT NULL UNIQUE,
    password   VARCHAR(128) NOT NULL,
    avatar     TEXT
);

DROP TABLE IF EXISTS content_type;
CREATE TABLE  content_type
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name  VARCHAR(128) NOT NULL UNIQUE,
    type VARCHAR(128) NOT NULL UNIQUE
);

DROP TABLE IF EXISTS post;
CREATE TABLE  post
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    title           VARCHAR(128),
    description     TEXT,
    quote_author    VARCHAR(128),
    image_url       TEXT,
    video_url       TEXT,
    link_url        TEXT,
    views_number    INT,
    user_id         INT,
    content_type_id INT,
    FOREIGN KEY (user_id) REFERENCES user (id)
        ON UPDATE CASCADE,
    FOREIGN KEY (content_type_id) REFERENCES content_type (id)
        ON UPDATE CASCADE
);


DROP TABLE IF EXISTS  comment;
CREATE TABLE  comment
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    comment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    content      TEXT,
    user_id      INT,
    post_id      INT,
    FOREIGN KEY (user_id) REFERENCES user (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES post (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

DROP TABLE IF EXISTS  user_post_like_relation;
CREATE TABLE  user_post_like_relation
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    post_id INT,
    FOREIGN KEY (user_id) REFERENCES user (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,

    FOREIGN KEY (post_id) REFERENCES post (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);


DROP TABLE IF EXISTS subscription;
CREATE TABLE subscription
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    follower_id INT,
    user_id     INT,
    FOREIGN KEY (follower_id) REFERENCES user (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES user (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

DROP TABLE IF EXISTS message;
CREATE TABLE message
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    message_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    message      TEXT,
    sender_id    INT,
    recipient_id INT,
    FOREIGN KEY (sender_id) REFERENCES user (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (recipient_id) REFERENCES user (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

DROP TABLE IF EXISTS hashtag;
CREATE TABLE  hashtag
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name varchar(128) UNIQUE
);

DROP TABLE IF EXISTS post_tag;
CREATE TABLE  post_tag
(
    post_tag_id INT,
    hashtag_id  INT,
    FOREIGN KEY (post_tag_id) REFERENCES post (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (hashtag_id) REFERENCES hashtag (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);


CREATE FULLTEXT INDEX post_title_index ON post (title); # --https://dev.mysql.com/doc/refman/8.0/en/fulltext-search.html
CREATE FULLTEXT INDEX comment_index ON comment (content); # --https://www.mysqltutorial.org/activating-full-text-searching.aspx/

