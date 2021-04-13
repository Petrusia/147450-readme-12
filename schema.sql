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
    content_type_id INT,
    FOREIGN KEY (user_id) REFERENCES user (id),
    FOREIGN KEY (content_type_id) REFERENCES content_type (id)
);

CREATE
INDEX title ON post (title);
CREATE
INDEX content ON post (content);

CREATE TABLE comment
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    comment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    content      TEXT,
    user_id      INT,
    post_id      INT,
    FOREIGN KEY (user_id) REFERENCES user (id),
    FOREIGN KEY (post_id) REFERENCES post (id)
);

CREATE
INDEX comment ON comment (content);

CREATE TABLE likes
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    post_id INT
        FOREIGN KEY (user_id) REFERENCES user (id),
    FOREIGN KEY (post_id) REFERENCES post (id)
);

CREATE TABLE subscription
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    follower_id INT,
    user_id     INT,
    FOREIGN KEY (follower_id) REFERENCES user (id),
    FOREIGN KEY (user_id) REFERENCES user (id)
);

CREATE TABLE message
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    message_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    message      TEXT,
    sender_id    INT,
    recipient_id INT,
    FOREIGN KEY (sender_id) REFERENCES user (id),
    FOREIGN KEY (recipient_id) REFERENCES user (id)
);

CREATE TABLE hashtag
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name varchar(128) UNIQUE
);

CREATE TABLE content_type
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    type_name  VARCHAR(128) NOT NULL UNIQUE,
    class_name VARCHAR(128) NOT NULL UNIQUE
);

