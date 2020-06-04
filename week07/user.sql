-- clean up

DROP TABLE IF EXISTS usr;

-- setup

CREATE TABLE usr (
    id SERIAL PRIMARY KEY,
    username VARCHAR(256) NOT NULL,
    pass VARCHAR(255) NOT NULL
);
