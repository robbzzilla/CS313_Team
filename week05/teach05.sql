-- clean up

DROP TABLE IF EXISTS scripture;
DROP TABLE IF EXISTS topic;
DROP TABLE IF EXISTS scripture_topic;

-- setup

CREATE TABLE scripture (
	id SERIAL PRIMARY KEY,
	book VARCHAR(256) NOT NULL UNIQUE,
	chapter INT NOT NULL,
	verse INT NOT NULL,
	content TEXT NOT NULL
);

CREATE TABLE topic (
	id SERIAL PRIMARY KEY,
	name VARCHAR(256) NOT NULL
);

CREATE TABLE scripture_topic (
	id SERIAL PRIMARY KEY,
	scriptue_id INT REFERENCES scripture (id),
	topic_id INT REFERENCES topic (id)
);

-- initial values

INSERT INTO scripture (book, chapter, verse, content) VALUES ('John', 1, 5, 
	'And the light shineth in darkness; and the darkness comprehended it not.'); 
INSERT INTO scripture (book, chapter, verse, content) VALUES ('Doctrine and Covenants', 88, 49, 
	'The light shineth in darkness, and the darkness comprehendeth it not; nevertheless, the day shall come when you shall comprehend even God, being quickened in him and by him.'); 
INSERT INTO scripture (book, chapter, verse, content) VALUES ('Doctrine and Covenants', 93, 28, 
	'He that keepeth his commandments receiveth truth and light, until he is glorified in truth and knoweth all things.'); 
INSERT INTO scripture (book, chapter, verse, content) VALUES ('Mosiah', 16, 9, 
	'He is the light and the life of the world; yea, a light that is endless, that can never be darkened; yea, and also a life which is endless, that there can be no more death.'); 

INSERT INTO topic (name) VALUES ('Faith');
INSERT INTO topic (name) VALUES ('Sacrifice');
INSERT INTO topic (name) VALUES ('Charity');