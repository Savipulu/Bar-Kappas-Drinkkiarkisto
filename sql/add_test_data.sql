-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Drinker (name, password) VALUES ('Jouni', 'Jouni123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Drinker (name, password) VALUES ('Vili', 'Vili123');
INSERT INTO Drinker (name, password) VALUES ('Sasu', 'salasana1');
INSERT INTO Drink (name, description, added) VALUES ('Rommikola', 'Rommia ja kolaa, duh!', NOW());
