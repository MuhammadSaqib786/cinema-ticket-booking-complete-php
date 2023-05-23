-- Create moviesdb
CREATE DATABASE IF NOT EXISTS moviesdb;

-- Use moviesdb
USE moviesdb;

-- Create Admin table
CREATE TABLE IF NOT EXISTS Admin (
  Aname VARCHAR(100) PRIMARY KEY,
  aemail VARCHAR(35) NOT NULL,
  Aphone INT(8) UNSIGNED UNIQUE,
  Apassword VARCHAR(100) NOT NULL
);

-- Insert a record in Admin table
INSERT INTO Admin (Aname, aemail, Aphone, Apassword)
VALUES ('admin', 'admin@gmail.com', 12345678, 'admin');


-- Create Customer table
CREATE TABLE myUser (
  user_id int PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(30) NOT NULL,
  email VARCHAR(50) NOT NULL Unique,
  age INT(3) NOT NULL,
  phone INT(10) NOT NULL
);


-- Create Movies table
CREATE TABLE IF NOT EXISTS Movies (
  movie_id INT(13) PRIMARY KEY AUTO_INCREMENT,
  movie_name VARCHAR(100) NOT NULL,
  release_date DATE NOT NULL,
  available_tickets INT(15) NOT NULL
);

-- Insert records for movies
INSERT INTO Movies (movie_name, release_date, available_tickets)
VALUES ('Avengers: Endgame', '2023-05-21', 4);
INSERT INTO Movies (movie_name, release_date, available_tickets)
VALUES ('Inception', '2023-05-22', 3);
INSERT INTO Movies (movie_name, release_date, available_tickets)
VALUES ('The Dark Knight', '2023-05-23', 3);

-- Create MovieBooking table
CREATE TABLE IF NOT EXISTS MovieBooking (
  booking_id INT(13) PRIMARY KEY AUTO_INCREMENT,
  movie_id INT(13),
  user_id INT NOT NULL,
  booking_date DATE NOT NULL,
  totalAmount INT(15) NOT NULL,
  noOfseats INT NOT NULL,
  FOREIGN KEY (movie_id) REFERENCES Movies(movie_id),
  FOREIGN KEY (user_id) REFERENCES myUser(user_id)
);

