# task1-imagobsi
## Create a Database First
CREATE DATABASE test1_imago
USE test1_imago

CREATE TABLE userdata (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(100) NOT NULL,
email VARCHAR(100) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL
);
