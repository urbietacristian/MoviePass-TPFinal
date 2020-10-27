  use RvUowCmyIb
  drop table users
  
  CREATE TABLE users (
  id_user INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(50) NOT NULL,
  id_role INT NOT NULL,
  Constraint pk_user PRIMARY KEY(id_user),
  Constraint fk_id_role FOREIGN KEY (id_role) references roles (id_role)
  
  )
  
  insert into roles (id_role, name) values (1, 'admin')
  
  insert into users (email, password, id_role) values ('admin@utn.com.ar', 'admin', 1)
  
select * from users;

CREATE TABLE cinemas (
id_cinema INT NOT NULL auto_increment,
name varchar(50) not null,
address varchar(50) not null,
total_capacity INT NOT NULL,
Constraint pk_cinema PRIMARY KEY(id_cinema)
)

select * from cinemas;

create table genres(
id_genre INT NOT NULL,
name varchar(50) NOT NULL,
Constraint pk_id_genre PRIMARY KEY(id_genre)
)

CREATE TABLE rooms (
id_room INT NOT NULL auto_increment,
name varchar(50) not null,
price INT NOT NULL,
capacity INT NOT NULL,
id_cinema INT NOT NULL,
Constraint pk_room PRIMARY KEY(id_room),
Constraint fk_cinema FOREIGN KEY (id_cinema) references cinemas (id_cinema)
)

select * from rooms;

CREATE TABLE roles(
id_role INT NOT NULL auto_increment,
name varchar(50) NOT NULL,
Constraint pk_role PRIMARY KEY(id_role)
)

select * from roles;

create table movies(
id_api INT,
name varchar(50),
description varchar(100),
image varchar(500),
language varchar(50),
constraint pk_id_movie primary key (id_api)
)
select * from movies;

create table cinemashow(
id_cinemashow INT NOT NULL AUTO_INCREMENT,
id_room INT NOT NULL,
id_movie INT NOT NULL,
day date,
time time,
constraint pk_id_cinemashow primary key (id_cinemashow),
Constraint fk_id_room FOREIGN KEY (id_room) references rooms (id_room),
Constraint fk_id_movie FOREIGN KEY (id_movie) references movies (id_api)
)

select * from cinemashow;

create table moviesxgenres (
id_moviexgenre INT NOT NULL AUTO_INCREMENT,
id_movie INT NOT NULL,
id_genre INT NOT NULL,
constraint pk_id_moviexgenre primary key (id_moviexgenre),
Constraint fk_movie FOREIGN KEY (id_movie) references movies (id_api),
Constraint fk_genre FOREIGN KEY (id_genre) references genres (id_genre)
)

create table PeliculasXgenero
(
	id_pelicula int,
    id_genero int,
    constraint pk_id_pelicula_id_genero primary key (id_pelicula,id_genero),
    constraint fk_id_pelicula foreign key (id_pelicula) references Peliculas (id_api),
    constraint fk_id_genero foreign key (id_genero) references Generos (id_genero)
);
drop table moviesxgenres



















