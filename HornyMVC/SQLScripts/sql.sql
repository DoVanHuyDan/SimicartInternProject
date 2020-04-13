CREATE DATABASE horny;

use horny;

CREATE TABLE products (
    id int NOT NULL AUTO_INCREMENT,
    image  varchar(255) NOT NULL,
    name  varchar(255) NOT NULL,
    price int,
    PRIMARY KEY (id)
); 


INSERT INTO products (image, name, price) VALUES ('imeg', 'name1', 1);
INSERT INTO products (image, name, price) VALUES ('imeg', 'name2', 2);
INSERT INTO products (image, name, price) VALUES ('imeg', 'name3', 3);
INSERT INTO products (image, name, price) VALUES ('imeg', 'name4', 4);