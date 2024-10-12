CREATE DATABASE obifyV2;
USE obifyV2;

CREATE TABLE usuario(
user_id INT AUTO_INCREMENT PRIMARY KEY,
mail VARCHAR(50),
user_name VARCHAR(50),
password_u VARCHAR(60),
user_admin TINYINT(1) DEFAULT 0,
path_img VARCHAR(255) DEFAULT 'default.png'
);

CREATE TABLE pelicula(
peli_id INT AUTO_INCREMENT PRIMARY KEY,
titulo VARCHAR(50),
sinopsis TEXT,
path_img VARCHAR(250)
);

-- La password es 1234 --
INSERT INTO usuario (user_id,mail,user_name,password_u,user_admin,path_img)
VALUES (1, 'david@gmail.com', 'david', '$2y$10$Cnq4aG9Lyl9TMvVbPvYr9OOySHXYS7ROeg4iv619oHZM6suQ.rJ2W', '1','default.png'),
(2, 'dayanna@gmail.com', 'dayanna', '$2y$10$Cnq4aG9Lyl9TMvVbPvYr9OOySHXYS7ROeg4iv619oHZM6suQ.rJ2W', '0','default.png');