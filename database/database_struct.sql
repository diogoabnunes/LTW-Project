PRAGMA encoding="UTF-8";
PRAGMA foreign_keys=true;

DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Propose;
DROP TABLE IF EXISTS Adoption;
DROP TABLE IF EXISTS FavoritePets;
DROP TABLE IF EXISTS MyPets;
DROP TABLE IF EXISTS Photos;
DROP TABLE IF EXISTS Pet;
DROP TABLE IF EXISTS Species;
DROP TABLE IF EXISTS User;

CREATE TABLE User (
    id INTEGER PRIMARY KEY,
    username VARCHAR UNIQUE,
    password VARCHAR NOT NULL,
    name VARCHAR NOT NULL,
    birth_date DATE NOT NULL,
    gender CHAR(1) CHECK (gender = 'M' OR gender = 'F'),
    location VARCHAR
);

CREATE TABLE Species (
    id INTEGER PRIMARY KEY,
    species VARCHAR NOT NULL,
    breed VARCHAR,
    UNIQUE(species, breed)
);

CREATE TABLE Pet (
    id INTEGER PRIMARY KEY,
    petname VARCHAR NOT NULL,
    description VARCHAR NOT NULL,
    speciesId INTEGER REFERENCES Species,
    gender CHAR(1) CHECK (gender = "M" or gender = "F"),
    color VARCHAR,
    birth_date DATE CHECK (DATE(birth_date) IS NOT NULL) NOT NULL,
    location VARCHAR,
    state VARCHAR CHECK(state = 'adopted' OR state = 'not adopted') NOT NULL
);

CREATE TABLE Photos (
    id INTEGER PRIMARY KEY,
    img VARCHAR,
    petId INTEGER REFERENCES Pet,
    userId INTEGER REFERENCES User
);

CREATE TABLE MyPets (
    userId INTEGER REFERENCES User,
    petId INTEGER REFERENCES Pet,
    PRIMARY KEY (userId, petId)
);

CREATE TABLE FavoritePets (
    userId INTEGER REFERENCES User,
    petId INTEGER REFERENCES Pet,
    PRIMARY KEY (userId, petId)
);

CREATE TABLE Adoption (
    userId INTEGER REFERENCES User,
    petId INTEGER REFERENCES Pet,
    PRIMARY KEY (userId, petId)
);

CREATE TABLE Propose (
    id INTEGER PRIMARY KEY,
    description VARCHAR NOT NULL,
    date DATE NOT NULL,
    hour NUMBER NOT NULL,
    state VARCHAR CHECK(state = 'accepted' OR state = 'rejected' OR state = 'processing') NOT NULL,
    userId INTEGER REFERENCES User,
    petId INTEGER REFERENCES Pet
);

CREATE TABLE Comment (
    id INTEGER PRIMARY KEY,
    comment VARCHAR NOT NULL,
    date DATE NOT NULL,
    hour NUMBER NOT NULL,
    userId INTEGER REFERENCES User,
    petId INTEGER REFERENCES Pet,
    proposeId INTEGER REFERENCES Propose
);