
INSERT INTO Kayttaja (Nimi, Salasana)
VALUES ('Admin','test');

INSERT INTO Askare (Nimi, Kayttaja_id)
SELECT 'Osta pizza', id FROM Kayttaja
WHERE Nimi = 'Admin';

INSERT INTO Luokka (Nimi, Kayttaja_id)
SELECT 'Huvi', id FROM Kayttaja
WHERE Nimi = 'Admin';

INSERT INTO Tarkeysaste (Nimi, Arvo, Kayttaja_id)
SELECT 'Kriittinen', 10, id FROM Kayttaja
WHERE Nimi = 'Admin';

INSERT INTO Askareenluokka (Askare_id, Luokka_id)
SELECT A.id, B.id
FROM (SELECT id FROM Askare WHERE Nimi = 'Osta pizza') A,
(SELECT id FROM Luokka WHERE Nimi = 'Huvi') B
WHERE 1 = 1;