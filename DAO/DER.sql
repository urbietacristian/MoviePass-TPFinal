#USE moviepassdefault;
#create database moviepassdefault
#drop database moviepassdefault

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
    release_date date,
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

CREATE TABLE `tickets` (
  `id_ticket` int NOT NULL AUTO_INCREMENT,
  `id_movieshow` int NOT NULL,
  `id_purchase` int DEFAULT NULL,
  `ticket_number` int DEFAULT NULL,
  PRIMARY KEY (`id_ticket`),
  KEY `fk_movieshow` (`id_movieshow`),
  KEY `fk_purchase` (`id_purchase`),
  CONSTRAINT `fk_movieshow` FOREIGN KEY (`id_movieshow`) REFERENCES `movieshow` (`id_movieshow`),
  CONSTRAINT `fk_purchase` FOREIGN KEY (`id_purchase`) REFERENCES `purchases` (`id_purchase`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `purchases` (
  `id_purchase` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `total` int DEFAULT NULL,
  `subtotal` int DEFAULT NULL,
  `discount` boolean DEFAULT NULL,
  PRIMARY KEY (`id_purchase`),
  KEY `fk_id_user` (`id_user`),
  CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DELIMITER $$
create procedure sp_returnLastTicket(in id_movieshowE int)
begin
select tickets.ticket_number from tickets where tickets.id_movieshow = 2 order by tickets.ticket_number desc limit 1;
end$$


DELIMITER $$
create procedure sp_totalByMovie(in id_movieI int,in dateIN date,IN dateOUT date)
begin
	SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
    select sum(purchases.total) as totalVendido from purchases 
	inner join (select tickets.* from tickets inner join purchases on purchases.id_purchase = tickets.id_purchase group by purchases.id_purchase) as tick on tick.id_purchase=purchases.id_purchase 
	inner join movieshow on tick.id_movieshow= movieshow.id_movieshow 
	inner join rooms on movieshow.id_room=rooms.id_room 
	inner join movies on movies.id_api=movieshow.id_movie
	where movies.id_api= id_movieI and purchases.date BETWEEN dateIN AND dateOUT;
end$$

DELIMITER $$
create procedure sp_totalByCinema(in idCinemaI int,in dateIN date,In dateOUT date)
begin
   SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
	select sum(purchases.total) as totalVendido from purchases 
	inner join (select tickets.* from tickets inner join purchases on purchases.id_purchase = tickets.id_purchase group by purchases.id_purchase) as tick on tick.id_purchase=purchases.id_purchase 
	inner join movieshow on tick.id_movieshow= movieshow.id_movieshow 
	inner join rooms on movieshow.id_room=rooms.id_room 
	inner join cinemas on cinemas.id_cinema=rooms.id_cinema
	where cinemas.id_cinema= idCinemaI and purchases.date BETWEEN dateIN AND dateOUT;
end$$


-- INSERTANDO AL ADMIN --

INSERT INTO roles (id_role, name) VALUES (1, 'admin');  
INSERT INTO users (email, password, id_role) VALUES ('admin@utn.com', 'admin', 1);

