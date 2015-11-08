-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Drinker (name, password) VALUES ('Jouni', 'Jouni123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Drinker (name, password) VALUES ('Vili', 'Vili123');
INSERT INTO Drinker (name, password) VALUES ('Sasu', 'salasana1');
INSERT INTO Drink (name, alcohol_content, volume, description) VALUES ('Rommikola', 8.5, 200, 'Rommi + kola + lime');
INSERT INTO Ingredient (name, saldo, description) VALUES ('Rommi', 0.0, 'Suosittu alkoholijuoma');
