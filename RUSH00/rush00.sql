CREATE TABLE users(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) CHARACTER SET latin1 NOT NULL, created_at datetime NOT NULL, Passwd VARCHAR(255) CHARACTER SET latin1 NOT NULL, admin INT(1));
CREATE TABLE cart(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, item_id INT NOT NULL, quantity INT NOT NULL, user INT NOT NULL, price INT NOT NULL, valid INT(1));
CREATE TABLE stock(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) CHARACTER SET latin1 NOT NULL, quantity INT NOT NULL, img_link VARCHAR(255) CHARACTER SET latin1 NOT NULL, ete INT(1), hiver INT(1), hipster INT(1), new INT(1), price INT NOT NULL);

INSERT INTO stock VALUES (NULL, 'Chaussette', '1000', 'img/chaussette.jpg', '0', '0', '0', '1', '4');
INSERT INTO stock VALUES (NULL, 'Super-hero', '1000', 'img/chaussette1.jpg', '0', '0', '0', '1', '5');
INSERT INTO stock VALUES (NULL, 'Soccet', '1000', 'img/classic.jpeg', '0', '0', '0', '1', '6');
INSERT INTO stock VALUES (NULL, 'Raye', '1000', 'img/classic2.jpeg', '0', '0', '0', '1', '7');
INSERT INTO stock VALUES (NULL, 'Hipster', '1000', 'img/hipster1.png', '0', '0', '1', '0', '7');
INSERT INTO stock VALUES (NULL, 'Hipster2', '1000', 'img/hipster2.jpg', '0', '0', '1', '0', '7');
INSERT INTO stock VALUES (NULL, 'Hipster3', '1000', 'img/hipster3.jpg', '0', '0', '1', '0', '7');
INSERT INTO stock VALUES (NULL, 'Hipster4', '1000', 'img/hipster4.jpg', '0', '0', '1', '0', '7');
INSERT INTO stock VALUES (NULL, 'ete1', '1000', 'img/chaussette2.jpg', '1', '0', '0', '0', '7');
INSERT INTO stock VALUES (NULL, 'ete2', '1000', 'img/ete2.jpg', '1', '0', '0', '0', '7');
INSERT INTO stock VALUES (NULL, 'ete3', '1000', 'img/ete3.jpg', '1', '0', '0', '0', '7');
INSERT INTO stock VALUES (NULL, 'ete4', '1000', 'img/ete1.jpg', '1', '0', '0', '0', '7');
INSERT INTO stock VALUES (NULL, 'hiver1', '1000', 'img/chaussette3.jpg', '0', '1', '0', '0', '7');
INSERT INTO stock VALUES (NULL, 'hiver2', '1000', 'img/chaushiv.jpg', '0', '1', '0', '0', '7');
INSERT INTO stock VALUES (NULL, 'hiver3', '1000', 'img/hiver1.jpeg', '0', '1', '0', '0', '7');
INSERT INTO stock VALUES (NULL, 'hiver4', '1000', 'img/hiver2.jpg', '0', '1', '0', '0', '7');
