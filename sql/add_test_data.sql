-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Drinker (name, password) VALUES ('Jouni', 'Jouni123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Drinker (name, password) VALUES ('Vili', 'Vili123');
INSERT INTO Drinker (name, password) VALUES ('Sasu', 'salasana1');
INSERT INTO Drinker (name, password) VALUES ('Kayttaja', 'Salasana1');
INSERT INTO Drinker (name, password) VALUES ('Yllapitaja', 'Salasana 2');

INSERT INTO Drink (name, alcohol_content, volume, description) VALUES ('Rommikola', 8.5, 200, 'Rommi + kola + lime');
INSERT INTO Drink (name, alcohol_content, volume, glass, drink_type, description, preparation_time) VALUES ('Martini', 15, 190, 'Martinilasi', 'Drinkki', 'Suosittu drinkki', 5);
INSERT INTO Drink (name, alcohol_content, volume, glass, drink_type, description, preparation_time) VALUES ('Bleeding Fetus 666', 25, 8, 'Kuppi', 'Shotti', 'Maista oliota, joka ei ehtinyt koskaan kuolla!', 12);

INSERT INTO Ingredient (name, saldo, description) VALUES ('Rommi', 100.0, 'Suosittu alkoholijuoma');
INSERT INTO Ingredient (name, saldo, description) VALUES ('Coca-cola', 100.0, 'Tunnettu kolajuoma');

INSERT INTO Favourite (drinker, drink) VALUES (1, 1);

INSERT INTO DrinkIngredient (drink, ingredient, amount) VALUES (1, 1, 100.0);
INSERT into DrinkIngredient (drink, ingredient, amount) VALUES (1, 2, 100.0);
