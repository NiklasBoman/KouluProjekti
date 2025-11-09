CREATE TABLE Kayttajat (
    KayttajaID INT AUTO_INCREMENT PRIMARY KEY,
    Nimi VARCHAR(50) NOT NULL,
    Gmail VARCHAR(100) NOT NULL UNIQUE,
    SalasanaHash VARCHAR(255) NOT NULL,
    PuhelinNro VARCHAR(20)
);

CREATE TABLE Huoneet (
    HuoneID INT AUTO_INCREMENT PRIMARY KEY,
    HuoneNimi VARCHAR(50) NOT NULL,
    Rakennus VARCHAR(50) NOT NULL,
    Kerros INT NOT NULL,
    Paikat INT NOT NULL
);

CREATE TABLE Varaukset (
    VarausID INT AUTO_INCREMENT PRIMARY KEY,
    KayttajaID INT NOT NULL,
    HuoneID INT NOT NULL,
    VarausAlku DATETIME NOT NULL,
    VarausLoppu DATETIME NOT NULL,
    VarausStatus VARCHAR(50) DEFAULT 'varattu',
    FOREIGN KEY (KayttajaID) REFERENCES Kayttajat(KayttajaID)
        ON DELETE CASCADE,
    FOREIGN KEY (HuoneID) REFERENCES Huoneet(HuoneID)
        ON DELETE CASCADE
);


-- testidatan lisäys
-- Lisää käyttäjä "Topi" (salasana 1234)
INSERT INTO Kayttajat (Nimi, Gmail, SalasanaHash, PuhelinNro)
VALUES (
    'Topi',
    'topi@example.com',
    '$2y$10$nOUIs5kJ7naTuTFkBy1veuK0kSxUFXfuaOKdOKf9xYT0KKIGSJwFa',  -- Hash for '1234' created with password_hash()
    '0401234567'
);

-- Lisätään muutamia luokkahuoneita
INSERT INTO Huoneet (HuoneNimi, Rakennus, Kerros, Paikat)
VALUES
    ('A101', 'Päärakennus', 1, 25),
    ('A102', 'Päärakennus', 1, 30),
    ('B201', 'Teknologiatalo', 2, 20),
    ('C305', 'Musiikkitalo', 3, 15);