DROP TABLE IF EXISTS userList;

CREATE TABLE userList (
    user_id SERIAL PRIMARY KEY,
    username CHAR(256) NOT NULL,
    passwrd CHAR(256) NOT NULL
);
