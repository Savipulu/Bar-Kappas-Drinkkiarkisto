-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Drinker (
    id SERIAL PRIMARY KEY,
    name varchar(50) NOT NULL,
    password varchar(50) NOT NULL
);

CREATE TABLE Drink (
    id SERIAL PRIMARY KEY,
    name varchar(50) NOT NULL,
    in_stock boolean DEFAULT FALSE,
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
    juoja integer NOT NULL,
    drinkki integer NOT NULL,
    FOREIGN KEY(juoja) REFERENCES Drinker(id),
    FOREIGN KEY(drinkki) REFERENCES Drink(id)
);

CREATE TABLE DrinkIngredient (
    drinkki integer NOT NULL,
    ainesosa integer NOT NULL,
    FOREIGN KEY(drinkki) REFERENCES Drink(id),
    FOREIGN KEY(ainesosa) REFERENCES Ingredient(id)
);
