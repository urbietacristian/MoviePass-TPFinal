USE moviepassdefault;

-- CREACIÓN DE TABLAS --

CREATE TABLE roles (
	id_role int NOT NULL AUTO_INCREMENT,
	name varchar(50) NOT NULL,
	CONSTRAINT pk_role PRIMARY KEY (id_role)
);

CREATE TABLE users (
	id_user int NOT NULL AUTO_INCREMENT,
	email varchar(50) NOT NULL UNIQUE,
	password varchar(100) NOT NULL,
	id_role int NOT NULL,
	CONSTRAINT pk_user PRIMARY KEY (id_user),
	CONSTRAINT fk_id_role FOREIGN KEY (id_role) REFERENCES roles (id_role)  
);

CREATE TABLE cinemas (
	id_cinema int NOT NULL AUTO_INCREMENT,
	name varchar(50) NOT NULL,
	address varchar(50) NOT NULL,
	CONSTRAINT pk_cinema PRIMARY KEY (id_cinema)
);

CREATE TABLE rooms (
	id_room int NOT NULL AUTO_INCREMENT,
	name varchar(50) NOT NULL,
	price int NOT NULL,
	capacity int NOT NULL,
	id_cinema int NOT NULL,
	CONSTRAINT pk_room PRIMARY KEY (id_room),
    CONSTRAINT fk_cinema FOREIGN KEY (id_cinema) REFERENCES cinemas (id_cinema) ON DELETE CASCADE ON UPDATE CASCADE
);

create table genres (
	id_genre int NOT NULL,
	name varchar(50) NOT NULL,
	CONSTRAINT pk_id_genre PRIMARY KEY (id_genre)
);

create table movies (
	id_api int NOT NULL,
	name varchar(50),
	description varchar(2000),
	image varchar(500),
	language varchar(50),
	duration int NOT NULL,
	CONSTRAINT pk_id_movie PRIMARY KEY (id_api)
);

CREATE TABLE movieshow (
	id_movieshow int NOT NULL AUTO_INCREMENT,
	id_room int NOT NULL,
	id_movie int NOT NULL,
	day date NOT NULL,
	time time NOT NULL,
    CONSTRAINT pk_id_movieshow PRIMARY KEY (id_movieshow),
	CONSTRAINT fk_id_movie FOREIGN KEY (id_movie) REFERENCES movies (id_api) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_id_room FOREIGN KEY (id_room) REFERENCES rooms (id_room)
);

create table moviesxgenres (
	id_moviexgenre int NOT NULL AUTO_INCREMENT,
	id_movie int NOT NULL,
	id_genre int NOT NULL,
	CONSTRAINT pk_id_moviexgenre PRIMARY KEY (id_moviexgenre),
	CONSTRAINT fk_movie FOREIGN KEY (id_movie) REFERENCES movies (id_api),
	CONSTRAINT fk_genre FOREIGN KEY (id_genre) REFERENCES genres (id_genre)
);

-- INSERTANDO AL ADMIN --

INSERT INTO roles (id_role, name) VALUES (1, 'admin');  
INSERT INTO users (email, password, id_role) VALUES ('admin@utn.com', 'admin', 1);

-- SELECTS ÚTILES --

select * from cinemas;

select * from genres;

select * from movies;

select * from movieshow;

select * from moviesxgenres;

select * from roles;

select * from rooms;

select * from users;
