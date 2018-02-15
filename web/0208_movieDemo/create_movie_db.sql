CREATE DATABASE movies;

CREATE TABLE movie
(
	id SERIAL PRIMARY KEY,
	title VARCHAR(256) NOT NULL,
	year SMALLINT NOT NULL,
	rating VARCHAR(5)
);

CREATE TABLE actor
(
	id SERIAL PRIMARY KEY,
	name VARCHAR(256) NOT NULL,
	gender CHAR(1)
);

CREATE TABLE movieActor
(
	id SERIAL PRIMARY KEY,
	movieId INT NOT NULL REFERENCES movie(id),
	actorId INT NOT NULL REFERENCES actor(id)
);

INSERT INTO movie(title, year, rating) VALUES ('Beauty and the Beast', 2017, 'PG');
INSERT INTO movie(title, year, rating) VALUES
  ('Harry Potter and the Sorcerer''s Stone', 2001, 'PG'),
  ('Solo: A Star Wars story', 2018, NULL),
  ('Mission Impossible', 1996, 'PG-13');

INSERT INTO actor(name, gender) VALUES
  ('Tom Cruise', 'M'),
  ('Emma Watson', 'F'),
  ('Emma Stone', 'F'),
  ('Bill Murray', 'M');

INSERT INTO actor(name, gender) VALUES
  ('Daniel Radcliffe', 'M');

INSERT INTO movieActor(movieId, actorId) VALUES
  (2, 5),
  (2, 2),
  (1, 2),
  (4, 1);

INSERT INTO movieActor(movieId, actorId) VALUES
  (
   (SELECT id FROM movie WHERE title LIKE 'Harry%'),
   (SELECT id FROM actor WHERE name = 'Bill Murray')
  );

SELECT m.title AS MovieTitle, a.name AS ActorName FROM movie m
JOIN movieActor ma ON m.id = ma.movieId
JOIN actor a ON ma.actorId = a.id
WHERE title = 'Harry Potter and the Sorcerer''s Stone';

SELECT m.title FROM actor a
JOIN movieActor ma ON a.id = ma.actorId
JOIN movie m ON ma.movieId = m.id
WHERE a.name = 'Tom Cruise';

CREATE USER movieapp WITH PASSWORD 'jeff';
GRANT SELECT, INSERT, UPDATE ON ALL TABLES IN SCHEMA public TO movieApp;
