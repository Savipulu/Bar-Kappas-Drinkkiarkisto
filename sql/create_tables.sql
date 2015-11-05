-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Drinker (
    id SERIAL PRIMARY KEY,
    name varchar(50) NOT NULL,
    password varchar(50) NOT NULL
);

CREATE TABLE Drink(
    id SERIAL PRIMARY KEY,
    name varchar(50) NOT NULL,
    in_stock boolean DEFAULT FALSE,
    description varchar(400),
    added DATE
);
