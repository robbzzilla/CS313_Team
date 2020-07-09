CREATE DATABASE familyhistory;

CREATE TABLE person
(
    person_id SERIAL PRIMARY KEY NOT NULL,
    first_name VARCHAR(256) NOT NULL,
    last_name VARCHAR(256) NOT NULL,
    birthday date
);

CREATE TABLE relationship
(
    id SERIAL PRIMARY KEY NOT NULL,
    parent INT REFERENCES person (person_id),
    child INT REFERENCES person (person_id)
);

INSERT INTO person(first_name, last_name, birthday) VALUES
('Braden', 'Rice', '1995-08-21'),
('Robert', 'Hampton', '1993-02-08'),
('Jose', 'Paz', '1980-06-30');

CREATE USER familyhistoryuser WITH PASSWORD "group02";
GRANT SELECT, INSERT, UPDATE ON person TO familyhistoryuser;
GRANT USAGE, SELECT ON SEQUENCE person_id_seq TO familyhistoryuser;