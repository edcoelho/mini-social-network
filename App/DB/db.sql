CREATE DATABASE IF NOT EXISTS cleckr;

CREATE TABLE IF NOT EXISTS cleckr.user(
    id INT AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    nickname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    bio VARCHAR(255),
    birth_date DATE NOT NULL,
    gender VARCHAR(16) NOT NULL,
    pwd_hash VARCHAR(255) NOT NULL,
    PRIMARY KEY(id),
    UNIQUE(nickname, email)
);

CREATE TABLE IF NOT EXISTS cleckr.post(
    id INT AUTO_INCREMENT,
    text VARCHAR(350) NOT NULL,
    image VARCHAR(255),
    datetime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    user_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES cleckr.`user`(id)
);

CREATE TABLE IF NOT EXISTS cleckr.following(
    id INT AUTO_INCREMENT,
    user_id INT NOT NULL,
    followed_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES cleckr.`user`(id),
    FOREIGN KEY(followed_id) REFERENCES cleckr.`user`(id)
)