DROP TABLE IF EXISTS "user";

CREATE TABLE "user" (
  email VARCHAR(255) UNIQUE NOT NULL,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (email)
);


CREATE TABLE "itineraire" (
  
);
