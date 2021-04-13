CREATE TABLE user
(
    id                INT AUTO_INCREMENT PRIMARY KEY,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email             VARCHAR(128) NOT NULL UNIQUE,
    login             VARCHAR(128) NOT NULL UNIQUE,
    password          VARCHAR(128) NOT NULL,
    avatar_url        TEXT
);

CREATE TABLE post
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    creation_date   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    title           TEXT,
    content         TEXT,
    quote_author    VARCHAR(128),
    image_url       TEXT,
    video_url       TEXT,
    link_url        TEXT,
    views_number    INT,
    user_id         INT,
    content_type_id INT
);

CREATE INDEX title ON post (title);
CREATE INDEX content ON post (content);

CREATE TABLE comment
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    comment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    content      TEXT,
    user_id      INT,
    post_id      INT
);

CREATE INDEX comment ON comment (content);

CREATE TABLE likes
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    post_id INT
);

CREATE TABLE subscription
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    follower_id INT,
    user_id     INT
);

CREATE TABLE message
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    message_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    message      TEXT,
    sender_id    INT,
    recipient_id INT
);

CREATE TABLE hashtag
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name varchar(128) UNIQUE
);

CREATE TABLE content_type
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    type_name  VARCHAR(128) UNIQUE,
    class_name VARCHAR(128) UNIQUE
);

