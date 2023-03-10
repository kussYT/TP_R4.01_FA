DROP TABLE IF EXISTS "user", "trajets" CASCADE;

CREATE TABLE "user"
(
    email    VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(255)        NOT NULL,
    password VARCHAR(255)        NOT NULL,
    PRIMARY KEY (email)
);

CREATE TABLE "trajets"
(
    id      SERIAL PRIMARY KEY,
    depart  VARCHAR(255) NOT NULL,
    arrivee VARCHAR(255) NOT NULL,
    date    DATE         NOT NULL,
    prix    INTEGER      NOT NULL,
    email   VARCHAR(255) NOT NULL,
    FOREIGN KEY (email) REFERENCES "user" (email)
);