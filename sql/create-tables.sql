
CREATE TABLE Kayttaja
(
id SERIAL PRIMARY KEY,
Nimi varchar(255),
Salasana varchar(255)
);


CREATE TABLE Luokka
(
id SERIAL PRIMARY KEY,
Nimi varchar(255),
Kayttaja_id INTEGER REFERENCES Kayttaja(id)  ON DELETE cascade
                                             ON UPDATE cascade
);

CREATE TABLE Tarkeysaste
(
id SERIAL PRIMARY KEY,
Nimi varchar(255),
Arvo integer,
Kayttaja_id INTEGER REFERENCES Kayttaja(id)  ON DELETE cascade
                                             ON UPDATE cascade
);

CREATE TABLE Askare
(
id SERIAL PRIMARY KEY,
Nimi varchar(255),
Kayttaja_id INTEGER REFERENCES Kayttaja(id)  ON DELETE cascade
                                             ON UPDATE cascade,
Tarkeysaste_id INTEGER REFERENCES Tarkeysaste(id)  ON DELETE SET NULL
                                                   ON UPDATE cascade
);


CREATE TABLE Askareenluokka
(
Askare_id INTEGER REFERENCES Askare(id)      ON DELETE cascade
                                             ON UPDATE cascade,
Luokka_id INTEGER REFERENCES Luokka(id)      ON DELETE cascade
                                             ON UPDATE cascade,
PRIMARY KEY (Askare_id,Luokka_id)
);

