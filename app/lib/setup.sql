
    /*
    Thực hiện ở mySql trước 
    */
    Drop database if exists minima_db;
    create database minima_db;
    GRANT ALL ON minima_db.* TO 'duy'@'localhost' IDENTIFIED BY '1119';
    GRANT ALL ON minima_db.* TO 'duy'@'127.0.0.1' IDENTIFIED BY '1119';
  use minima_db;
  /*  --2:41:39*/
Drop table if exists users;
CREATE TABLE users (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    url_address VARCHAR(60),
    username VARCHAR(50),
    password VARCHAR(64),
    email VARCHAR(100),
    date DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` 
(`id`, `url_address`, `username`, `password`, `email`, `date`)
 VALUES (NULL, 'kWtb05Cmq', 'test', '123', 'thanhduy191103@gmail.com', '2023-01-19 20:10:26') ;
/*3:07:14*/
Drop table if exists images;

CREATE TABLE images (
    id INTEGER NOT NULL KEY AUTO_INCREMENT,
    title VARCHAR(255),
    image VARCHAR(500),
    date DATETIME,
    description VARCHAR(500)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE images
ADD FK_user INTEGER,
ADD CONSTRAINT FOREIGN KEY(FK_user) REFERENCES users(id) ON DELETE CASCADE; 
/*
INSERT INTO `images` 
(`id`, `title`, `image`, `date`, `description`, `FK_user`) 
VALUES (NULL, '123', 'uploads/dom event cheet sheet.jpg', '2023-01-19 20:13:23', '123', '1') 

*/