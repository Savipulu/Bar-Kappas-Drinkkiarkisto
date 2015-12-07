-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Drinker (
    id SERIAL PRIMARY KEY,
    name varchar(50) NOT NULL,
    password varchar(50) NOT NULL
);

CREATE TABLE Drink (
    id SERIAL PRIMARY KEY,
    name varchar(50) NOT NULL,
    alcohol_content float NOT NULL,
    volume integer NOT NULL,
    glass varchar(50),
    drink_type varchar(50),
    description varchar(500),
    preparation_time integer
);

CREATE TABLE Ingredient (
    id SERIAL PRIMARY KEY,
    name varchar(50) NOT NULL,
    saldo float,
    description varchar(500)
);

CREATE TABLE Favourite (
    drinker integer NOT NULL,
    drink integer NOT NULL,
    FOREIGN KEY(drinker) REFERENCES Drinker(id),
    FOREIGN KEY(drink) REFERENCES Drink(id)
);

CREATE TABLE Recipes (
    drink integer NOT NULL,
    ingredient integer NOT NULL,
    amount float NOT NULL,
    FOREIGN KEY(drink) REFERENCES Drink(id),
    FOREIGN KEY(ingredient) REFERENCES Ingredient(id)
);
