drop schema public cascade;
create schema public;

CREATE TABLE usuario(
   id SERIAL PRIMARY KEY,
   nombre VARCHAR(100) NOT NULL,
   apellido VARCHAR(100) NOT NULL,
   username VARCHAR(100) NOT NULL UNIQUE,
   password VARCHAR(200) NOT NULL,
   email VARCHAR(200) NOT NULL UNIQUE,
   created_at TIMESTAMP,
   updated_at TIMESTAMP
);

CREATE TABLE anio(
   id SERIAL PRIMARY KEY,
   nombre VARCHAR(50) NOT NULL,
   created_at TIMESTAMP,
   updated_at TIMESTAMP
);

CREATE TABLE mes(
   id SERIAL PRIMARY KEY,
   nombre VARCHAR(50) NOT NULL,
   created_at TIMESTAMP,
   updated_at TIMESTAMP
);

CREATE TABLE clima(
   id SERIAL PRIMARY KEY,
   dia INTEGER NOT NULL,
   id_mes INTEGER REFERENCES mes(id),
   id_anio INTEGER REFERENCES anio(id),
   media numeric,
   created_at TIMESTAMP,
   updated_at TIMESTAMP
);

-- INSERT USUSUARIO
INSERT INTO usuario(nombre, apellido, username, password, email, created_at, updated_at)
VALUES('David', 'Coca', 'david', md5('654321'), 'hugo927@hotmail.com', now(), now());

-- INSERT ANIO
INSERT INTO anio(nombre, created_at, updated_at)
VALUES('2008 - 2009', now(), now());
INSERT INTO anio(nombre, created_at, updated_at)
VALUES('2009 - 2010', now(), now());
INSERT INTO anio(nombre, created_at, updated_at)
VALUES('2010 - 2011', now(), now());
INSERT INTO anio(nombre, created_at, updated_at)
VALUES('2011 - 2012', now(), now());
INSERT INTO anio(nombre, created_at, updated_at)
VALUES('2012 - 2013', now(), now());
INSERT INTO anio(nombre, created_at, updated_at)
VALUES('2013 - 2014', now(), now());
INSERT INTO anio(nombre, created_at, updated_at)
VALUES('2014 - 2015', now(), now());
INSERT INTO anio(nombre, created_at, updated_at)
VALUES('2015 - 2016', now(), now());

-- INSERT MES
INSERT INTO mes(nombre, created_at, updated_at)
VALUES('ENERO', now(), now());
INSERT INTO mes(nombre, created_at, updated_at)
VALUES('FEBRERO', now(), now());
INSERT INTO mes(nombre, created_at, updated_at)
VALUES('MARZO', now(), now());
INSERT INTO mes(nombre, created_at, updated_at)
VALUES('ABRIL', now(), now());
INSERT INTO mes(nombre, created_at, updated_at)
VALUES('MAYO', now(), now());
INSERT INTO mes(nombre, created_at, updated_at)
VALUES('JUNIO', now(), now());
INSERT INTO mes(nombre, created_at, updated_at)
VALUES('JULIO', now(), now());
INSERT INTO mes(nombre, created_at, updated_at)
VALUES('AGOSTO', now(), now());
INSERT INTO mes(nombre, created_at, updated_at)
VALUES('SEPTIEMBRE', now(), now());
INSERT INTO mes(nombre, created_at, updated_at)
VALUES('OCTUBRE', now(), now());
INSERT INTO mes(nombre, created_at, updated_at)
VALUES('NOVIEMBRE', now(), now());
INSERT INTO mes(nombre, created_at, updated_at)
VALUES('DICIEMBRE', now(), now());
