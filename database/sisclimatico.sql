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

CREATE TABLE anio_agricola(
    id SERIAL PRIMARY KEY,
	anio INTEGER NOT NULL,
	mes VARCHAR(50) NOT NULL,	
	dia INTEGER NOT NULL,
	precipitacion_pluvial NUMERIC,
	media NUMERIC,
	maxima NUMERIC,
	minima NUMERIC,
	pp_acum NUMERIC,
	media_acum NUMERIC,
	max_acum NUMERIC,
	min_acum NUMERIC,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE TABLE fenomeno(
   id SERIAL PRIMARY KEY,
   nombre VARCHAR(100) NOT NULL,
   created_at TIMESTAMP,
   updated_at TIMESTAMP
);

CREATE TABLE prediccion(
    id SERIAL PRIMARY KEY,
	id_fenomeno INTEGER REFERENCES fenomeno(id),
	hasta DATE,
	mes INTEGER NOT NULL,	
	dia INTEGER NOT NULL,
	minimo NUMERIC,
    anios INTEGER,
	valor_esperado NUMERIC,
	valor_maximo NUMERIC,
	valor_minimo NUMERIC,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE TABLE anio_prediccion(
    id SERIAL PRIMARY KEY,
    id_anio_agricola INTEGER REFERENCES anio_agricola(id),
	id_prediccion INTEGER REFERENCES prediccion(id),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- INSERT USUSUARIO
INSERT INTO usuario(nombre, apellido, username, password, email, created_at, updated_at)
VALUES('David', 'Coca', 'david', md5('654321'), 'hugo927@hotmail.com', now(), now());
INSERT INTO usuario(nombre, apellido, username, password, email, created_at, updated_at)
VALUES('Admin', 'Admin', 'admin', md5('s3cr3t'), 'admin@gmail.com', now(), now());

/*
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
*/

-- INSERT ANIO_AGRICOLA

-- INSERT FENOMENO
INSERT INTO fenomeno(nombre, created_at, updated_at)
VALUES('PRECIPITACIÓN', now(), now());
INSERT INTO fenomeno(nombre, created_at, updated_at)
VALUES('TEMPERATURA MEDIA', now(), now());
INSERT INTO fenomeno(nombre, created_at, updated_at)
VALUES('TEMPERATURA MAXIMA', now(), now());
INSERT INTO fenomeno(nombre, created_at, updated_at)
VALUES('TEMPERATURA MINIMA', now(), now());

-- INSERT PREDICCION
